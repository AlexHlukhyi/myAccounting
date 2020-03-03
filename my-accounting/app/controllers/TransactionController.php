<?php

namespace app\controllers;

use DateTime;

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
            $this->db->insTransaction($_POST['name'], $_POST['description'], $_POST['moneyAmount'], new DateTime($_POST['date'] . ' ' . $_POST['time']), $_SESSION['user']->id);
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
        if ($_GET['id'] && $_POST) {
            $this->db->editTransaction($_GET['id'], $_POST['name'], $_POST['description'], $_POST['moneyAmount'], new DateTime($_POST['date'] . ' ' . $_POST['time']));
        }
        header('Location: /transaction/index');
    }

    function destroy() {
        if ($_GET['id']) {
            $this->db->deleteTransaction($_GET['id']);
        }
        header('Location: /transaction/index');
    }
}