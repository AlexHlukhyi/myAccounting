<?php

namespace Model;

class AuthData extends Data {
    public function __construct() {
        parent::__construct();
        $this->db = new MySQLdb();
        $this->db->connect();
    }

    public function getUser($login) {
        $user = false;
        $sql = "select id, username, email, password 
                    from users 
                    where username='" . $login . "' or email='" . $login . "'";
        if($results = $this->db->getArrFromQuery($sql)) {
            if(count($results) > 0) {
                $result = $results[0];
                $user = new User();
                $user->setId($result['id']);
                $user->setUserName($result['username']);
                $user->setEmail($result['email']);
                $user->setPassword($result['password']);
            }
        }
        return $user;
    }

    public function insUser(User $user) {
        $sql = "insert into users(username, email, password) 
                    values('" . $user->getUserName() . "', '" . $user->getEmail() . "', '" . $user->getPassword() . "')";
        $this->db->runQuery($sql);
    }
}