<?php

    class User {
        static private bool $auth = false;
        static private string $login = '';
        static private string $token = '';

        static public function checkAuth(): bool {
            return self::$auth;
        }

        static public function logIn(string $login, string $token, bool $remember): void {
            self::$auth = true;
            self::$login = $login;
            self::$token = $token;
            if ($remember) self::cookieUpdate();
            self::sessionUpdate();
        }

        static public function logOut(): void {
            self::$auth = false;
            self::$login = '';
            self::cleanCookie();
            self::sessionUpdate();
        }

        static public function sessionUpdate(): void {
            $_SESSION['user']['auth'] = self::$auth;
            $_SESSION['user']['login'] = self::$login;
        }

        static public function cookieUpdate(): void {
            $time = time() + 2592000;
            setcookie('login', self::$login, $time, '/');
            setcookie('token', self::$token, $time, '/');
        }

        static public function cleanCookie(): void {
            $time = - 1;
            setcookie('login', self::$login, $time, '/');
            setcookie('token', self::$token, $time, '/');
        }

        static public function init(): void {
            if (empty($_SESSION['user']['auth']) && !self::initCookie($_COOKIE['login'] ?? '', $_COOKIE['token'] ?? '')) return;
            self::$auth = $_SESSION['user']['auth'];
            self::$login = $_SESSION['user']['login'];
            // обновить токен
        }

        static public function initCookie(string $login, string $token): bool {
            if (!$login || !$token) return false;
            if (!$user = DB::getUserByLoginAndToken($login, $token)) return false;
            $_SESSION['user']['auth'] = true;
            $_SESSION['user']['login'] = $user['login'];
            return true;
        }
    }