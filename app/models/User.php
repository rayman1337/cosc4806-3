<?php

class User {

    public $username;
    public $password;
    public $auth = false;

    public function __construct() {

    }

    public function test () {
      $db = db_connect();
      $statement = $db->prepare("select * from users;");
      $statement->execute();
      $rows = $statement->fetch(PDO::FETCH_ASSOC);
      return $rows;
    }

  public function logAuthenticationAttempts($username, $status) {
      $db = db_connect();
      $stmt = $db->prepare("INSERT INTO login_logs (username, attempt) VALUES (?, ?)");
      $stmt->execute([$username, $status]);
  }

  public function getFailedAuthenticationAttempts($username) {
      $db = db_connect();
      $stmt = $db->prepare("
          SELECT timestamp FROM login_logs 
          WHERE username = ? AND attempt = 'bad' 
          ORDER BY timestamp DESC 
          LIMIT 3
      ");
      $stmt->execute([$username]);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  
  public function authenticate($username, $password) {
      $username = strtolower($username);
      $db = db_connect();

      $recentFails = $this->getFailedAuthenticationAttempts($username);
      if (count($recentFails) === 3) {
          $lastFailTime = strtotime($recentFails[0]['timestamp']);
          if (time() - $lastFailTime < 60) {
              $_SESSION['error'] = "Too many failed attempts. Try again in 60 seconds.";
              header('Location: /login');
              exit;
          }
      }

    $stmt = $db->prepare("SELECT * FROM users WHERE username = :name");
    $stmt->bindValue(':name', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['auth'] = 1;
        $_SESSION['username'] = ucwords($username);
        $this->logAuthenticationAttempts($username, 'good');
        header('Location: /home');
        exit;
    } else {
        $this->logAuthenticationAttempts($username, 'bad');
        $_SESSION['error'] = "Invalid username or password.";
        header('Location: /login');
        exit;
    }
  }

  public function create_user($username, $password) {
      $db = db_connect();
      if (!$db) {
          return false; 
      }

      try {
          $checkDupeUser = $db->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
          $checkDupeUser->execute([$username]);
          $userExists = $checkDupeUser->fetchColumn();  

          if ($userExists) {
              return false;
          }

          $hashed_password = password_hash($password, PASSWORD_DEFAULT);
          $statement = $db->prepare("INSERT INTO users (username, password) VALUES (?, ?);");
          $statement->execute([$username, $hashed_password]);
          return $statement->rowCount();
      } catch (PDOException $ex) {
          error_log("Error creating user: " . $ex->getMessage());
          return false;  
      }
  }
}