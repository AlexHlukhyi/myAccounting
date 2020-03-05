<?php

namespace sys;

use DateTime;

class View {
    public static function make($view, $data = null) {
        include '../resources/views/' . $view . '.php';
    }
}