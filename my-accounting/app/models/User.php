<?php

namespace app\models;

class User {
    private $id;
    private $username;
    private $email;
    private $password;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getUserName() {
        return $this->username;
    }
    public function setUserName($username) {
        $this->username = $username;
    }

    public function getEmail(){
        return $this->email;
    }
    public function setEmail($email) {
        $this->email = $email;
    }

    public function getPassword() {
        return $this->password;
    }
    public function setPassword($password) {
        $this->password = $password;
    }

    public function checkPassword($password) {
        if($this->password == $password) {
            return true;
        }
        return false;
    }
}