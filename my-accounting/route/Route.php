<?php

namespace Route;

class Route {
    public static function index() {
        header('Location: /transaction/index');
    }
    public static function login() {
        header('Lcation: /auth/login');
    }
}