<?php

namespace sys;

use app\controllers;

class Router {
    private $controller;
    private static $routes;

    public function __construct() {
        session_start();
        self::$routes = array();
    }

    private static function add($method, $route, $action) {
        $params = explode('@', $action);
        $controller = $params[0];
        $function = $params[1];
        self::$routes[$method][] = [
            'route' => $route,
            'controller' => $controller,
            'function' => $function
        ];
    }

    public static function get($route, $action) {
        self::add('get', $route, $action);
    }

    public static function post($route, $action) {
        self::add('post', $route, $action);
    }

    public function run() {
        $method = strtolower($_SERVER['REQUEST_METHOD']);
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
    }

    public function altrun() {
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
            //include '../app/controllers/' . $controller . '.php';
            $controller = 'app\controllers\\' . $controller;
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