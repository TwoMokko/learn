<?php

    if (User::checkAuth()) \Base\Response::sendError();



	$login = $_POST['login'];
	$pass = $_POST['pass'];
	$remember = isset($_POST['remember']);

    if ($user = DB::getUserByLoginAndPass($login, $pass)) {
        User::logIn($user['login'], $user['token'], $remember);
        \Base\Response::sendOk();
    }

//    foreach ($users as $user) {
//        if ($user['login'] === $login) {
//            if ($user['password'] === $pass) {
//                User::logIn($user['login'], $user['token']);
//                \Base\Response::sendOk();
//            }
//            \Base\Response::sendError('пароль неверный');
//        }
//
//    }

    \Base\Response::sendError('пользователь не найден');