<?php

class Login extends Controller {

		public function index() {
				$error = $_SESSION['error'] ?? null;
				unset($_SESSION['error']); 

				$this->view('login/index', ['error' => $error]);
		}

		public function verify() {
				if ($_SERVER['REQUEST_METHOD'] === 'POST') {
						$username = trim($_POST['username']);
						$password = trim($_POST['password']);

						$userModel = $this->model('User');
						$userModel->authenticate($username, $password);
				} else {
						header('Location: /login');
						exit;
				}
		}
}
