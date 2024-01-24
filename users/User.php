<?php

    class User {
        static private bool $auth = false;
        static private string $login = '';

        static public function checkAuth(): bool {
            return self::$auth;
        }

        static public function logIn($login): void {
            self::$auth = true;
            self::$login = $login;
            self::sessionUpdate();
        }

        static public function logOut(): void {
            self::$auth = false;
            self::$login = '';
            self::sessionUpdate();
        }

        static public function sessionUpdate(): void {
            $_SESSION['user']['auth'] = self::$auth;
            $_SESSION['user']['login'] = self::$login;
        }

        static public function init(): void {
            if (empty($_SESSION['user']['auth'])) return;
            self::$auth = $_SESSION['user']['auth'];
            self::$login = $_SESSION['user']['login'];
        }
    }