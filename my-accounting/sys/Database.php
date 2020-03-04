<?php

namespace sys;

use config\Config;
use DateTime;
use PDO;

class Database {
    private $db;

    public function __construct() {
        try {
            $this->db = new PDO('mysql:host=' . Config::$host . ';dbname=' . Config::$db, Config::$user, Config::$pwd);
        } catch (\Exception $ex) {
            die($ex);
        }
    }

    public function getUser($login) {
        $statement = $this->db->prepare('select id, username, email, password from users where username = :login or email = :login');
        $statement->setFetchMode(PDO::FETCH_OBJ);
        $statement->bindParam(':login', $login);
        $statement->execute();
        $user = $statement->fetch();
        return $user;
    }

    public function insUser($user) {
        $statement = $this->db->prepare('insert into users (username, email, password) values (:username, :email, :password)');
        $statement->execute($user);
    }

    public function getTransactions($idUser) {
        $transactions = array();
        $statement = $this->db->prepare('select id, name, description, moneyAmount, date, idUser from transactions where idUser = :idUser');
        $statement->setFetchMode(PDO::FETCH_OBJ);
        $statement->bindParam(":idUser", $idUser);
        $statement->execute();
        while($transaction = $statement->fetch()) {
            $transactions[] = $transaction;
        }
        return $transactions;
    }

    public function getTransaction($idTransaction) {
        $statement = $this->db->prepare('select id, name, description, moneyAmount, date from transactions where id = :idTransaction');
        $statement->setFetchMode(PDO::FETCH_OBJ);
        $statement->bindParam(':idTransaction', $idTransaction);
        $statement->execute();
        $transaction = $statement->fetch();
        return $transaction;
    }

    public function insTransaction($transaction) {
        $statement = $this->db->prepare('insert into transactions(name, description, moneyAmount, date, idUser) values(:name, :description, :moneyAmount, :date, :idUser)');
        $statement->execute($transaction);
    }

    public function editTransaction($transaction) {
        $statement = $this->db->prepare('update transactions set name = :name, description = :description, moneyAmount = :moneyAmount, date = :date where id = :id');
        $statement->execute($transaction);
    }

    public function deleteTransaction($transactionId) {
        $statement = $this->db->prepare('delete from transactions where id = ?');
        $statement->bindParam(1, $transactionId);
        $statement->execute();
    }
}