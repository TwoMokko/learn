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
                case 'do_login': self::onlyUnLoginXHR(\User::class, 'doLogin'); return;
                case 'do_registration': self::onlyUnLoginXHR(\User::class, 'doRegistration'); return;
                case 'do_logout': self::onlyLoginXHR(\User::class,'doLogout'); return;
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

        static private function onlyUnLoginXHR(string $class, string $method, string $errorMessage = 'вы уже вошли'): void {
            if (\User::checkAuth()) Response::sendError($errorMessage);
            forward_static_call_array([$class, $method], []);
        }

        static private function onlyLoginXHR(string $class, string $method, string $errorMessage = 'войдите, чтобы продолжить'): void {
            if (!\User::checkAuth()) Response::sendError($errorMessage);
            forward_static_call_array([$class, $method], []);
        }
    }