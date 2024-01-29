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
                case 'profile': self::onlyLoginHTML(DIR_PAGES . 'profile.php'); return;
                case 'login': self::onlyUnLoginHTML(DIR_PAGES . 'login.php'); return;
                case 'registration': self::onlyUnLoginHTML(DIR_PAGES . 'registration.php'); return;
                case 'do_login': self::onlyUnLoginXHR(DIR_ROOT . 'auth/doLogin.php'); return;
                case 'do_registration': self::onlyUnLoginXHR(DIR_ROOT . 'auth/doRegistration.php'); return;
                case 'do_logout': self::onlyLoginXHR(DIR_ROOT . 'auth/doLogout.php'); return;
                case '404': require DIR_PAGES . '404.php'; return;
                default: require DIR_PAGES . '404.php';
            }
        }

        static private function onlyUnLoginHTML(string $path): void {
            if (\User::checkAuth()) { require DIR_PAGES . '404.php'; return; }
            require $path;
        }

        static private function onlyLoginHTML(string $path): void {
            if (!\User::checkAuth()) { require DIR_PAGES . '404.php'; return; }
            require $path;
        }

        static private function onlyUnLoginXHR(string $path, string $errorMessage = 'вы уже вошли'): void {
            if (\User::checkAuth()) Response::sendError($errorMessage);
            require $path;
        }

        static private function onlyLoginXHR(string $path, string $errorMessage = 'войдите, чтобы продолжить'): void {
            if (!\User::checkAuth()) Response::sendError($errorMessage);
            require $path;
        }
    }