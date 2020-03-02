<?php

namespace Controller;

use Model\Data;
use View\View;

class Controller {
    protected $view;
    protected $model;

    public function __construct() {
        session_start();
        $this->view = new View();
    }
}