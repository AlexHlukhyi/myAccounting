<?php

namespace Controller;

use Model\Data;
use View\View;

class Controller {
    protected $model;
    protected $view;

    public function __construct() {
        session_start();
        $this->model = new Data();
        $this->view = new View();
    }
}