<?php

namespace app\controllers;

use DateTime;
use sys\Controller;

class TransactionController extends Controller {
    function index() {
        $transactions = $this->db->getTransactions($_SESSION['user']->id);
        $this->view->makeView('index', $transactions);
    }

    function create() {
        $this->view->makeView('create');
    }

    function store() {
        $date = new DateTime($_POST['date'] . ' ' . $_POST['time']);
        if ($_POST) {
            $this->db->insTransaction(array(
                'name' => $_POST['name'],
                'description' => $_POST['description'],
                'moneyAmount' => $_POST['description'],
                'date' => $date->format('Y-m-d H:i:s'),
                'idUser' => $_SESSION['user']->id,
            ));
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
        $date = new DateTime($_POST['date'] . ' ' . $_POST['time']);
        if ($_GET['id'] && $_POST) {
            $this->db->editTransaction(array(
                'id' => $_GET['id'],
                'name' => $_POST['name'],
                'description' => $_POST['description'],
                'moneyAmount' => $_POST['description'],
                'date' => $date->format('Y-m-d H:i:s'),
            ));
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