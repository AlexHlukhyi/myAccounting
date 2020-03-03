<?php

namespace app\controllers;

class AuthController extends Controller {
    function login() {
        $this->view->makeView('login');
    }

    function register() {
        $this->view->makeView('register');
    }

    function signin() {
        if ($user = $this->db->getUser($_POST['login'])) {
            if ($user->password == $_POST['password']) {
                $_SESSION['user'] = $user;
                header('Location: /transaction/index');
            }
        } else {
            die('User not found!');
        }
    }

    function signup() {
        if ($_POST['password'] == $_POST['repeat-password']) {
            if (!$user = $this->db->getUser($_POST['login'])) {
                $this->db->insUser($_POST['username'], $_POST['email'], $_POST['password']);
                $_SESSION['user'] = $this->db->getUser($_POST['username']);
                header('Location: /transaction/index');
            }
        }
    }

    function signout() {
        unset($_SESSION['user']);
        header('Location: /auth/login');
    }
}