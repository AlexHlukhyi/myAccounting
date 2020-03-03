<?php

namespace Model;

class Transaction {
    private $id;
    private $name;
    private $description;
    private $moneyAmount;
    private $date;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getMoneyAmount() {
        return $this->moneyAmount;
    }

    public function setMoneyAmount($moneyAmount) {
        $this->moneyAmount = $moneyAmount;
    }

    public function getDate() {
        return $this->date;
    }

    public function setDate($date) {
        $this->date = $date;
    }
}