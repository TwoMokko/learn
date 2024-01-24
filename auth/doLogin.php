<?php

    if (User::checkAuth()) \Base\Response::sendError();

    $users = [
        ['id' => 1, 'login' => 'qwerty1', 'password' => 'pass1', 'name' => 'Ivan', 'old' => 43],
        ['id' => 2, 'login' => 'qwerty2', 'password' => 'pass2', 'name' => 'Oleg', 'old' => 23],
        ['id' => 3, 'login' => 'qwerty3', 'password' => 'pass3', 'name' => 'Denis', 'old' => 46],
        ['id' => 4, 'login' => 'qwerty4', 'password' => 'pass4', 'name' => 'Vova', 'old' => 23],
        ['id' => 5, 'login' => 'qwerty5', 'password' => 'pass5', 'name' => 'Ira', 'old' => 23],
    ];

	$login = $_POST['login'];
	$pass = $_POST['pass'];

    foreach ($users as $user) {
        if ($user['login'] === $login) {
            if ($user['password'] === $pass) {
                User::logIn($login);
                \Base\Response::sendOk();
            }
            \Base\Response::sendError('пароль неверный');
        }

    }

    \Base\Response::sendError('пользователь не найден');