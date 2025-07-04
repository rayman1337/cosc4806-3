<?php

class Create extends Controller {

    public function index() {		
        $error = $_SESSION['error'] ?? null;
        $success = $_SESSION['success'] ?? null;
        unset($_SESSION['error'], $_SESSION['success']);

        $this->view('create/index', ['error' => $error, 'success' => $success]);
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);

            if (empty($username) || empty($password)) {
                $_SESSION['error'] = "Username and password are required.";
                header("Location: /create");
                exit;
            }

            if (strlen($password) < 10) {
                $_SESSION['error'] = "Password must be at least 10 characters.";
                header("Location: /create");
                exit;
            }

            $userModel = $this->model('User');
            $created = $userModel->create_user($username, $password);

            if ($created) {
                $_SESSION['success'] = "User created successfully!";
            } else {
                $_SESSION['error'] = "Username already exists.";
            }

            header("Location: /create");
            exit;
        }
    }
}
