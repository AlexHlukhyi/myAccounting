<?php

namespace sys;

class Controller {
    protected $view;
    protected $db;

    public function __construct() {
        $this->view = new View();
        $this->db = new Database();
    }
}