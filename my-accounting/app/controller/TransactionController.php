<?php

namespace Controller;

use DateTime;
use Model\Transaction;

class TransactionController extends Controller {
    public function __construct() {
        parent::__construct();
    }

    function index() {
        $transactions = $this->model->getTransactions($_SESSION['user']->getId());
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
            $this->model->insTransaction($transaction, $_SESSION['user']->getId());
        }
        header('Location: index');
    }

    function edit() {
        if ($_GET) {
            $transaction = $this->model->getTransaction($_GET['id']);
            $this->view->makeView('edit', $transaction);
        } else {
            header('Location: index');
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
            $this->model->editTransaction($transaction);
        }
        header('Location: index');
    }

    function destroy() {
        if ($_GET) {
            $transaction = new Transaction();
            $transaction->setId($_GET['id']);
            $this->model->deleteTransaction($transaction);
        }
        header('Location: index');
    }
}