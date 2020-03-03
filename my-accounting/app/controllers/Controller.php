<?php

namespace app\controllers;

use database\Database;
use app\view\View;

class Controller {
    protected $view;
    protected $db;

    public function __construct() {
        $this->view = new View();
        $this->db = new Database();
    }
}