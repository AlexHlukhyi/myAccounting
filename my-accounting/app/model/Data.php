<?php

namespace Model;

class Data {
    protected $db;

    public function __construct() {
        $this->db = new MySQLdb();
        $this->db->connect();
    }
}