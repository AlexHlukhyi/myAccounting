<?php

class App {
    private $controller;

    public function __construct() {
        session_start();
    }

    public function run() {
        $action = 'index';
        $controller = 'TransactionController';
        //parsing url
        $routes = explode('/', str_replace('?', '/', $_SERVER['REQUEST_URI']));
        if (!empty($routes[1])) {
            $controller = ucfirst($routes[1]) . 'Controller';
        }
        if (!empty($routes[2])) {
            $action = $routes[2];
        }
        //check if user is already in session
        if (!in_array($action, array('login', 'signin', 'signup', 'signout', 'register'))) {
            if(!$_SESSION['user']) {
                $controller = 'AuthController';
                $action = 'login';
            }
        }

        if(file_exists('../app/controllers/' . $controller . '.php')) {
            include '../app/controllers/' . $controller . '.php';
            $controller = 'Controller\\' . $controller;
            $this->controller = new $controller();
            if(method_exists($this->controller, $action)) {
                $this->controller->$action();
            } else {
                die('Method' . $action . '() in ' . $controller . 'not found!');
            }
        } else {
            die($controller . ' not found!');
        }
    }
}