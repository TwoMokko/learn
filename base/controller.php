<?php

    namespace Base;

    abstract class Controller {
        static public string $page;

        static public function setPage(): void {
            self::$page = $_GET['page'] ?? 'main';
        }

        static public function redirect(): void {
            switch (self::$page) {
                case 'main': require DIR_PAGES . 'main.php'; return;
                case 'about': require DIR_PAGES . 'about.php'; return;
                case 'user': self::onlyLogin(DIR_PAGES . 'profile.php'); return;
                case 'login': self::onlyUnLogin(DIR_PAGES . 'login.php'); return;
                case 'registration': self::onlyUnLogin(DIR_PAGES . 'registration.php'); return;
                case 'do_login': self::onlyUnLogin(DIR_ROOT . 'auth/doLogin.php'); return;
                case 'do_registration': self::onlyUnLogin(DIR_ROOT . 'auth/doRegister.php'); return;
                case 'do_logout': self::onlyLogin(DIR_ROOT . 'auth/doLogout.php'); return;
                case '404': require DIR_PAGES . '404.php'; return;
                default: require DIR_PAGES . '404.php';
            }
        }

        static private function onlyUnLogin(string $path): void {
            if (\User::checkAuth()) { require DIR_PAGES . '404.php'; return; }
            require $path;
        }

        static private function onlyLogin(string $path): void {
            if (!\User::checkAuth()) { require DIR_PAGES . '404.php'; return; }
            require $path;
        }
    }