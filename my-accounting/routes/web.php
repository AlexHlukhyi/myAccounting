<?php

use sys\Router;

Router::get('/login', 'AuthController@login');
Router::post('/signin', 'AuthController@signin');
Router::get('/register', 'AuthController@register');
Router::post('/signup', 'AuthController@signup');
Router::get('/signout', 'AuthController@signout');

Router::get('/', 'TransactionController@index');
Router::get('/transaction/create', 'TransactionController@create');
Router::post('/transaction/create', 'TransactionController@store');