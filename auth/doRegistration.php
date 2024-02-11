<?php
//	if (User::checkAuth()) \Base\Response::sendError();

	$login = $_POST['login'];
	$pass = $_POST['pass'];
	$repass = $_POST['repass'];
	$remember = isset($_POST['remember']);

    if (User::issetUserByLogin($login)) \Base\Response::sendError('такой пользователь уже существует');
    if (($validPass = User::validationPassword($pass, $repass)) < 0) \Base\Response::sendError(User::TEXT_ERRORS[$validPass]);

    if (!($userData = User::createUser($login, $pass))) \Base\Response::sendError('ошибка базы данных');

    User::logIn($userData['login'], $userData['token'], $remember);
    \Base\Response::sendOk();
