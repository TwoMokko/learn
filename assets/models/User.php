<?php

namespace assets\models;

use core;
use DB;
use JetBrains\PhpStorm\NoReturn;

class User
{
    const VALIDATION_OK = 1;
    const VALIDATION_ERROR_LENGTH = -1;
    const VALIDATION_ERROR_REPASS = -2;

    const TEXT_ERRORS = [
        self::VALIDATION_ERROR_LENGTH => 'слишком короткий пароль',
        self::VALIDATION_ERROR_REPASS => 'пароли не совпадают'
    ];

    const SALT_LOCAL = '9e7224f5c6';

    static private bool $auth = false;
    static private string $login = '';
    static private string $token = '';

    static public function checkAuth(): bool
    {
        return self::$auth;
    }

    static public function logIn(string $login, string $token, bool $remember): void
    {
        self::$auth = true;
        self::$login = $login;
        self::$token = $token;
        if ($remember) self::cookieUpdate();
        self::sessionUpdate();
    }

    static public function logOut(): void
    {
        self::$auth = false;
        self::$login = '';
        self::cleanCookie();
        self::sessionUpdate();
    }

    static public function sessionUpdate(): void
    {
        $_SESSION['user']['auth'] = self::$auth;
        $_SESSION['user']['login'] = self::$login;
    }

    static public function cookieUpdate(): void
    {
        $time = time() + 2592000;
        setcookie('login', self::$login, $time, '/');
        setcookie('token', self::$token, $time, '/');
    }

    static public function cleanCookie(): void
    {
        $time = -1;
        setcookie('login', self::$login, $time, '/');
        setcookie('token', self::$token, $time, '/');
    }

    static public function init(): void
    {
        if (empty($_SESSION['user']['auth']) && !self::initCookie($_COOKIE['login'] ?? '', $_COOKIE['token'] ?? '')) return;
        self::$auth = $_SESSION['user']['auth'];
        self::$login = $_SESSION['user']['login'];
        // обновить токен
    }

    static public function initCookie(string $login, string $token): bool
    {
        if (!$login || !$token) return false;
        if (!$user = DB::getUserByLoginAndToken($login, $token)) return false;
        $_SESSION['user']['auth'] = true;
        $_SESSION['user']['login'] = $user['login'];
        return true;
    }

    static public function issetUserByLogin($login): bool
    {
        return DB::issetUserByLogin($login);
    }

    static public function validationPassword(string $pass, string $repass): int
    {
        if (mb_strlen($pass) < 8) return self::VALIDATION_ERROR_LENGTH;
        if ($pass !== $repass) return self::VALIDATION_ERROR_REPASS;
        return self::VALIDATION_OK;
    }

    static public function createUser(string $login, string $pass): array|false
    {
        $token = self::generateToken();
        [$encryptionPass, $salt] = self::encryptionPassword($pass);
        if (!DB::createUser($login, $encryptionPass, $salt, $token)) return false;
        return [
            'login' => $login,
            'token' => $token,
        ];
    }

    static private function generateToken(): string
    {
        $count = rand(8, 16);
        $specialSymbols = '0123456789qwertyuiopasdfghjklzxcvbnm!@#$%^&*U()_-=+';
        $countSymbols = mb_strlen($specialSymbols) - 1;
        for ($i = 1, $str = ''; $i < $count; $i++) {
            $position = rand(0, $countSymbols);
            $str .= $specialSymbols[$position];
        }
        return hash('sha256', $str);
    }

    static private function encryptionPassword(string $pass): array
    {
        $saltUser = bin2hex(random_bytes(rand(3, 5)));
        $str = $pass . $saltUser . self::SALT_LOCAL;

        return [hash('sha256', $str), $saltUser];
    }

    static private function comparePassword(string $pass, string $userPass, string $userSalt): bool
    {
        return hash('sha256', $pass . $userSalt . self::SALT_LOCAL) === $userPass;
    }

    #[NoReturn] static public function doLogin(): void
    {
        $login = $_POST['login'];
        $pass = $_POST['pass'];
        $remember = isset($_POST['remember']);

        if (!$user = DB::getUserByLogin($login)) core\Response::sendError('пользователь не найден');
        if (!self::comparePassword($pass, $user['password'], $user['salt'])) core\Response::sendError('пароль введен неверно');

        self::logIn($user['login'], $user['token'], $remember);
        core\Response::sendOk();
    }

    #[NoReturn] static public function doRegistration(): void
    {
        $login = $_POST['login'];
        $pass = $_POST['pass'];
        $repass = $_POST['repass'];
        $remember = isset($_POST['remember']);

        if (self::issetUserByLogin($login)) core\Response::sendError('такой пользователь уже существует');
        if (($validPass = self::validationPassword($pass, $repass)) < 0) core\Response::sendError(self::TEXT_ERRORS[$validPass]);

        if (!($userData = self::createUser($login, $pass))) core\Response::sendError('ошибка базы данных');

        self::logIn($userData['login'], $userData['token'], $remember);
        core\Response::sendOk();
    }

    #[NoReturn] static public function doLogout(): void
    {
        self::logOut();
        redirect();
    }

}

