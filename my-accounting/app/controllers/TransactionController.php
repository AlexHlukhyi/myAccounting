<?php

namespace app\controllers;

use DateTime;
use sys\Controller;
use sys\DB;
use sys\View;

class TransactionController extends Controller {
    function index() {
        $transactions = DB::getInstance()->select('select id, name, description, money_amount, date, id_user from transactions where id_user = :idUser', ['idUser' => $_SESSION['user']->id]);
        View::make('index', $transactions);
    }

    function create() {
        View::make('create');
    }

    function store() {
        if ($_POST) {
            $date = new DateTime($_POST['date'] . ' ' . $_POST['time']);
            DB::getInstance()->insert('insert into transactions (name, description, money_amount, date, id_user) values (:name, :description, :money_amount, :date, :id_user)', [
                'name' => $_POST['name'],
                'description' => $_POST['description'],
                'money_amount' => $_POST['moneyAmount'],
                'date' => $date->format('Y-m-d H:i:s'),
                'id_user' => $_SESSION['user']->id,
            ]);
        }
        header('Location: /transactions');
    }

    function edit() {
        if ($_GET) {
            $transaction = DB::getInstance()->select('select id, name, description, money_amount, date from transactions where id = :id', ['id' => $_GET['id']]);
            View::make('edit', $transaction[0]);
        } else {
            header('Location: /transactions');
        }
    }

    function update() {
        if ($_GET['id'] && $_POST) {
            $date = new DateTime($_POST['date'] . ' ' . $_POST['time']);
            DB::getInstance()->update('update transactions set name = :name, description = :description, money_amount = :money_amount, date = :date where id = :id', [
                'id' => $_GET['id'],
                'name' => $_POST['name'],
                'description' => $_POST['description'],
                'money_amount' => $_POST['moneyAmount'],
                'date' => $date->format('Y-m-d H:i:s')
            ]);
        }
        header('Location: /transactions');
    }

    function destroy() {
        if ($_GET['id']) {
            DB::getInstance()->delete('delete from transactions where id = :id', ['id' => $_GET['id']]);
        }
        header('Location: /transactions');
    }
}