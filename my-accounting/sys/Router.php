<?php

namespace sys;

//use app\controllers\AuthController;
//use app\controllers\TransactionController;

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
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        if (!$_SESSION['user'] && !in_array($path, array('/login', '/signin', '/signup', '/signout', '/register'))) {
            $this->controller = new \app\controllers\AuthController();
            $this->controller->login();
            return;
        }
        foreach (self::$routes[$method] as $route) {
            if ($route['route'] == $path) {
                $controller = '\app\controllers\\' . $route['controller'];
                $this->controller = new $controller();
                $function = $route['function'];
                $this->controller->$function();
                return;
            }
        }
        $this->controller = new \app\controllers\TransactionController();
        $this->controller->index();
    }
}