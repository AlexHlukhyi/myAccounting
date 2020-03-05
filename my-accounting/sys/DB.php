<?php

namespace sys;

use config\Config;
use PDO;

class DB {
    private static $db;
    private static $instance = null;

    private function __clone () {}

    public static function getInstance() {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public static function connect() {
        try {
            self::$db = new PDO('mysql:host=' . Config::$host . ';dbname=' . Config::$db, Config::$user, Config::$pwd);
        } catch (\Exception $ex) {
            die($ex);
        }
    }

    public static function select($sql, $data) {
        $result = [];
        self::connect();
        $statement = self::$db->prepare($sql);
        $statement->setFetchMode(PDO::FETCH_OBJ);
        $statement->execute($data);
        while ($value = $statement->fetch()) {
            $result[] = $value;
        }
        return $result;
    }

    public static function insert($sql, $data) {
        self::connect();
        $statement = self::$db->prepare($sql);
        $statement->execute($data);
        return self::$db->lastInsertId();
    }

    public static function update($sql, $data) {
        self::connect();
        $statement = self::$db->prepare($sql);
        $statement->execute($data);
    }

    public static function delete($sql, $data) {
        self::connect();
        $statement = self::$db->prepare($sql);
        $statement->execute($data);
    }
}