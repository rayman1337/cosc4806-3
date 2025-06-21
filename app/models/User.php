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