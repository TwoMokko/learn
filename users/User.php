<?php

    class User {
        const VALIDATION_OK = 1;
        const VALIDATION_ERROR_LENGTH = - 1;
        const VALIDATION_ERROR_REPASS = - 2;

        const TEXT_ERRORS = [
            self::VALIDATION_ERROR_LENGTH => 'слишком короткий пароль',
            self::VALIDATION_ERROR_REPASS => 'пароли не совпадают'
        ];

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

        static public function issetUserByLogin($login): bool {
            return DB::issetUserByLogin($login);
        }

        static public function validationPassword(string $pass, string $repass): int {
            if (mb_strlen($pass) < 8) return self::VALIDATION_ERROR_LENGTH;
            if ($pass !== $repass) return self::VALIDATION_ERROR_REPASS;
            return self::VALIDATION_OK;
        }

        static public function createUser(string $login, string $pass): array|false {
            $token = self::generateToken();
            if (!DB::createUser($login, $pass, $token)) return false;
            return [
                'login' => $login,
                'token' => $token,
            ];
        }

        static private function generateToken(): string {
            $count = rand(8, 16);
            $specialSymbols = '0123456789qwertyuiopasdfghjklzxcvbnm!@#$%^&*U()_-=+';
            $countSymbols = mb_strlen($specialSymbols) - 1;
            for ($i = 1, $str = ''; $i < $count; $i++) {
                $position = rand(0, $countSymbols);
                $str .= $specialSymbols[$position];
            }
            return hash('sha256', $str);
        }
    }