<?php

namespace app\view;

use DateTime;

class View {
    public function makeView($view, $data = null) {
        include '../resources/views/' . $view . '.php';
    }
}