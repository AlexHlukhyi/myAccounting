<?php

namespace app\controllers;

use DateTime;
use app\models\Transaction;

class TransactionController extends Controller {
    function index() {
        $transactions = $this->db->getTransactions($_SESSION['user']->id);
        $this->view->makeView('index', $transactions);
    }

    function create() {
        $this->view->makeView('create');
    }

    function store() {
        if ($_POST) {
            $transaction = new Transaction();
            $transaction->setName($_POST['name']);
            $transaction->setDescription($_POST['description']);
            $transaction->setMoneyAmount($_POST['moneyAmount']);
            $transaction->setDate(new DateTime($_POST['date'] . ' ' . $_POST['time']));
            $this->db->insTransaction($transaction, $_SESSION['user']->getId());
        }
        header('Location: /transaction/index');
    }

    function edit() {
        if ($_GET) {
            $transaction = $this->db->getTransaction($_GET['id']);
            $this->view->makeView('edit', $transaction);
        } else {
            header('Location: /transaction/index');
        }
    }

    function update() {
        if ($_GET) {
            $transaction = new Transaction();
            $transaction->setId($_GET['id']);
            $transaction->setName($_POST['name']);
            $transaction->setDescription($_POST['description']);
            $transaction->setMoneyAmount($_POST['moneyAmount']);
            $transaction->setDate(new DateTime($_POST['date'] . ' ' . $_POST['time']));
            $this->db->editTransaction($transaction);
        }
        header('Location: /transaction/index');
    }

    function destroy() {
        if ($_GET) {
            $transaction = new Transaction();
            $transaction->setId($_GET['id']);
            $this->db->deleteTransaction($transaction);
        }
        header('Location: /transaction/index');
    }
}