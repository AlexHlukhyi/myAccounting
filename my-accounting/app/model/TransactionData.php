<?php

namespace Model;

use DateTime;

class TransactionData extends Data {
    public function __construct() {
        parent::__construct();
        $this->db = new MySQLdb();
        $this->db->connect();
    }

    public function getTransactions($userId) {
        $transactions = array();
        $sql = "select id, name, description, moneyAmount, date, idUser 
                    from transactions
                    where idUser = " . $userId . " order by date desc";
        if($results = $this->db->getArrFromQuery($sql)) {
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
        if($results = $this->db->getArrFromQuery($sql)) {
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
        $this->db->runQuery($sql);
    }

    public function editTransaction(Transaction $transaction) {
        $sql = "update transactions 
                    set 
                        name='" . $transaction->getName() .
            "', description='" . $transaction->getDescription() .
            "', moneyAmount=" . $transaction->getMoneyAmount() .
            ", date='" . $transaction->getDate()->format('Y-m-d H:i:s') .
            "' where id=" . $transaction->getId();
        $this->db->runQuery($sql);
    }

    public function deleteTransaction(Transaction $transaction) {
        $sql = "delete from transactions where id=" . $transaction->getId();
        $this->db->runQuery($sql);
    }
}