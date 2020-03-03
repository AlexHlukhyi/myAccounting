<?php

namespace Databases;

use Configs\Config;
use Model\Transaction;
use Model\User;

// not edited yet, still using mysqli
class Database {
    private $link;
    public $err;

    public function connect() {
        $this->link = new \mysqli(Config::$server, Config::$user, Config::$pwd, Config::$db);
        if(!$this->link) {
            return false;
        }
        $this->runQuery("SET NAMES 'utf-8");
        return true;
    }

    public function disconnect() {
        $this->link->close();
        unset($this->link);
    }

    public function runQuery($sql) {
        $this->connect();
        $res = $this->link->query($sql);
        if(!$res) {
            $this->err = $this->link->error;
        }
        $this->disconnect();
        return $res;
    }

    public function getArrFromQuery($sql) {
        $res_arr = [];
        $rs = $this->runQuery($sql);
        while($row = $rs->fetch_assoc()) {
            $res_arr[] = $row;
        }
        return $res_arr;
    }

    public function getUser($login) {
        $user = false;
        $sql = "select id, username, email, password 
                    from users 
                    where username='" . $login . "' or email='" . $login . "'";
        if($results = $this->getArrFromQuery($sql)) {
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

    public function getTransactions($userId) {
        $transactions = array();
        $sql = "select id, name, description, moneyAmount, date, idUser 
                    from transactions
                    where idUser = " . $userId . " order by date desc";
        if($results = $this->getArrFromQuery($sql)) {
            foreach($results as $result) {
                $transaction = new Transaction();
                $transaction->setId($result['id']);
                $transaction->setName($result['name']);
                $transaction->setDescription($result['description']);
                $transaction->setMoneyAmount($result['moneyAmount']);
                $transaction->setDate(new DateTime($result['date']));
                $transactions[] = $transaction;
            }
        }
        return $transactions;
    }

    public function getTransaction($transactionId) {
        $transaction = false;
        $sql = "select name, description, moneyAmount, date, idUser 
                    from transactions
                    where id = " . $transactionId;
        if($results = $this->getArrFromQuery($sql)) {
            if (count($results) > 0) {
                $result = $results[0];
                $transaction = new Transaction();
                $transaction->setId($transactionId);
                $transaction->setName($result['name']);
                $transaction->setDescription($result['description']);
                $transaction->setMoneyAmount($result['moneyAmount']);
                $transaction->setDate(new DateTime($result['date']));
                $transactions[] = $transaction;
            }
        }
        return $transaction;
    }

    public function insTransaction(Transaction $transaction, $userId) {
        $sql = "insert into transactions(name, description, moneyAmount, date, idUser) 
                    values('" . $transaction->getName() . "', '" . $transaction->getDescription() . "', " . $transaction->getMoneyAmount() . ", '" . $transaction->getDate()->format('Y-m-d H:i:s') . "', " . $userId . ")";
        $this->runQuery($sql);
    }

    public function editTransaction(Transaction $transaction) {
        $sql = "update transactions 
                    set 
                        name='" . $transaction->getName() .
            "', description='" . $transaction->getDescription() .
            "', moneyAmount=" . $transaction->getMoneyAmount() .
            ", date='" . $transaction->getDate()->format('Y-m-d H:i:s') .
            "' where id=" . $transaction->getId();
        $this->runQuery($sql);
    }

    public function deleteTransaction(Transaction $transaction) {
        $sql = "delete from transactions where id=" . $transaction->getId();
        $this->runQuery($sql);
    }
}