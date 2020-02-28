<?php

use Controller\AuthController;
use Controller\TransactionController;

class App {
    private $controller;

    public function __construct() {
        session_start();
    }

    public function run() {
        $action = 'index';
        //parsing url
        $routes = explode('/', str_replace('?', '/', $_SERVER['REQUEST_URI']));
        if (!empty($routes[1])) {
            $action = $routes[1];
        }
        //check if user is already in session
        if (!in_array($action, array('login', 'signin', 'signup', 'signout', 'register'))) {
            if(!$_SESSION['user']) {
                $action = 'login';
            }
        }
        //wrong routing here :(
        //it works but it shouldn't look like that
        switch ($action) {
            case 'login': {
                $this->controller = new AuthController();
                $this->controller->login();
                break;
            }
            case 'register': {
                $this->controller = new AuthController();
                $this->controller->register();
                break;
            }
            case 'signin': {
                $this->controller = new AuthController();
                $this->controller->signin();
                break;
            }
            case 'signup': {
                $this->controller = new AuthController();
                $this->controller->signup();
                break;
            }
            case 'signout': {
                $this->controller = new AuthController();
                $this->controller->signout();
                break;
            }
            case 'create': {
                $this->controller = new TransactionController();
                $this->controller->create();
                break;
            }
            case 'store': {
                $this->controller = new TransactionController();
                $this->controller->store();
                break;
            }
            case 'edit': {
                $this->controller = new TransactionController();
                $this->controller->edit();
                break;
            }
            case 'update': {
                $this->controller = new TransactionController();
                $this->controller->update();
                break;
            }
            case 'destroy': {
                $this->controller = new TransactionController();
                $this->controller->destroy();
                break;
            }
            default: {
                $this->controller = new TransactionController();
                $this->controller->index();
                break;
            }
        }
    }
}