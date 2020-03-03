<?php

namespace Controllers;

use Model\User;

class AuthController extends Controller {
    function login() {
        $this->view->makeView('login');
    }

    function register() {
        $this->view->makeView('register');
    }

    function signin() {
        if ($user = $this->db->getUser($_POST['login'])) {
            if ($user->checkPassword($_POST['password'])) {
                $_SESSION['user'] = $user;
                header('Location: /transaction/index');
            }
        }
    }

    function signup() {
        if ($_POST['password'] == $_POST['repeat-password']) {
            if (!$user = $this->db->getUser($_POST['login'])) {
                $user = new User();
                $user->setUsername($_POST['username']);
                $user->setEmail($_POST['email']);
                $user->setPassword($_POST['password']);
                $this->db->insUser($user);
                $_SESSION['user'] = $user;
                header('Location: /transaction/index');
            }
        }
    }

    function signout() {
        unset($_SESSION['user']);
        header('Location: /auth/login');
    }
}