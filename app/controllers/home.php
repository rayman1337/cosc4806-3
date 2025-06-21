<?php

class Home extends Controller {

    public function index() {
        if (!isset($_SESSION['auth']) || $_SESSION['auth'] !== 1) {
            $_SESSION['error'] = "You must be logged in to view the home page.";
            header("Location: /login");
            exit;
        }

        $user = $this->model('User');
        $data = $user->test();

        $this->view('home/index');
        exit;
    }
}
