<?php

    namespace Core;

    abstract class Router {
        static public string $page;

        static public function setPage(): void {
            self::$page = $_GET['page'] ?? 'main';
        }

        static public function run(): void {
            self::setPage();
            switch (self::$page) {
                case 'main': require DIR_LAYOUTS . 'main.php'; return;
                case 'about': require DIR_VIEWS . 'general/about.php'; return;
                case 'profile': self::onlyLoginHTML(DIR_VIEWS . 'users/profile.php'); return;
                case 'login': self::onlyUnLoginHTML(DIR_VIEWS . 'users/login.php'); return;
                case 'registration': self::onlyUnLoginHTML(DIR_VIEWS . 'users/registration.php'); return;
                case 'do_login': self::onlyUnLoginXHR(\assets\models\User::class, 'doLogin'); return;
                case 'do_registration': self::onlyUnLoginXHR(\assets\models\User::class, 'doRegistration'); return;
                case 'do_logout': self::onlyLoginXHR(\assets\models\User::class,'doLogout'); return;
                case '404': require DIR_VIEWS . 'general/404.php'; return;
                case 'user': self::useController(self::$page); return;
                default: require DIR_VIEWS . 'general/404.php';
            }
        }

        static private function uploadController(string $controllerName): void {
            require DIR_CONTROLLERS . $controllerName . '.php';
        }
        static private function useController(string $controllerName): void {
            self::uploadController($controllerName);
            $controllerPath = '\Controller\\' . $controllerName;
            new $controllerPath();
        }

        static private function onlyUnLoginHTML(string $path): void {
            if (\assets\models\User::checkAuth()) { require DIR_VIEWS . 'general/404.php'; return; }
            require $path;
        }

        static private function onlyLoginHTML(string $path): void {
            if (!\assets\models\User::checkAuth()) { require DIR_VIEWS . 'general/404.php'; return; }
            require $path;
        }

        static private function onlyUnLoginXHR(string $class, string $method, string $errorMessage = 'вы уже вошли'): void {
            if (\assets\models\User::checkAuth()) Response::sendError($errorMessage);
            forward_static_call_array([$class, $method], []);
        }

        static private function onlyLoginXHR(string $class, string $method, string $errorMessage = 'войдите, чтобы продолжить'): void {
            if (!\assets\models\User::checkAuth()) Response::sendError($errorMessage);
            forward_static_call_array([$class, $method], []);
        }
    }