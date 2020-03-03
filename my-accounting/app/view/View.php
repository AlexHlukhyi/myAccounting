<?php

namespace View;

class View {
    public function makeView($view, $data = null) {
        include '/resources/views/' . $view . '.php';
    }
}