<?php

namespace app\controllers;

use sys\Controller;
use sys\DB;
use sys\View;

class AuthController extends Controller {
    function login() {
        View::make('login');
    }

    function register() {
        View::make('register');
    }

    function signin() {
        if ($user = DB::getInstance()->select('select * from users where username = :login or email = :login', [
            'login' => $_POST['login']
        ])) {
            if ($user->password == $_POST['password']) {
                $_SESSION['user'] = $user;
                header('Location: /transactions');
            }
        } else {
            die('User not found!');
        }
    }

    function signup() {
        if ($_POST['password'] == $_POST['repeat-password']) {
            if ($user = DB::getInstance()->select('select * from users where username = :username', ['username' => $_POST['username']])) {
                die('User with this username exists!');
            }
            if ($user = DB::getInstance()->select('select * from users where email = :email', ['email' => $_POST['email']])) {
                die('User with this e-mail exists!');
            }
            $id = DB::getInstance()->insert('insert into users (username, email, password) values (:username, :email, :password)', [
                'username' => $_POST['username'],
                'email' => $_POST['email'],
                'password' => $_POST['password']
            ]);
            $_SESSION['user'] = DB::getInstance()->select('select * from users where id = :id', ['id' => $id]);
            header('Location: /transactions');
        }
    }

    function signout() {
        unset($_SESSION['user']);
        header('Location: /login');
    }
}