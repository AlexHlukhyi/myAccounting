<?php

namespace Controller;

use Model\AuthData;
use Model\User;

class AuthController extends Controller {
    public function __construct() {
        parent::__construct();
        $this->model = new AuthData();
    }

    function login() {
        $this->view->makeView('login');
    }

    function register() {
        $this->view->makeView('register');
    }

    function signin() {
        if ($user = $this->model->getUser($_POST['login'])) {
            if ($user->checkPassword($_POST['password'])) {
                session_start();
                $_SESSION['user'] = $user;
                header('Location: /transaction/index');
            }
        }
    }

    function signup() {
        if ($_POST['password'] == $_POST['repeat-password']) {
            if (!$user = $this->model->getUser($_POST['login'])) {
                $user = new User();
                $user->setUsername($_POST['username']);
                $user->setEmail($_POST['email']);
                $user->setPassword($_POST['password']);
                $this->model->insUser($user);
                session_start();
                $_SESSION['user'] = $user;
                header('Location: /transaction/index');
            }
        }
    }

    function signout() {
        session_start();
        unset($_SESSION['user']);
        header('Location: /auth/login');
    }
}