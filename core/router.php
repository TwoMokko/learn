<?php

    namespace Core;

    abstract class Router {
        static public string $controller;
        static public string $method;
        static public array $aliases;

        static public function prepare(): void
        {
            self::$controller = $_GET['controller'] ?? 'main';
            self::$method = $_GET['method'] ?? 'index';
            self::setAlias();
            self::parseAlias();
        }

        static public function run(): void
        {
            self::prepare();
            Controller::init(self::$controller, self::$method);
            Template::init();
//            switch (self::$controller) {
//                case 'main': require DIR_LAYOUTS . 'default.tpl'; return;
//                case 'about': require DIR_VIEWS . 'general/about.php'; return;
//                case 'profile': self::onlyLoginHTML(DIR_VIEWS . 'users/profile.php'); return;
//                case 'login': self::onlyUnLoginHTML(DIR_VIEWS . 'users/login.php'); return;
//                case 'registration': self::onlyUnLoginHTML(DIR_VIEWS . 'users/registration.php'); return;
//                case 'do_login': self::onlyUnLoginXHR(\assets\models\User::class, 'doLogin'); return;
//                case 'do_registration': self::onlyUnLoginXHR(\assets\models\User::class, 'doRegistration'); return;
//                case 'do_logout': self::onlyLoginXHR(\assets\models\User::class,'doLogout'); return;
//                case '404': require DIR_VIEWS . 'general/404.php'; return;
//                case 'user': self::useController(); return;
//                default: require DIR_VIEWS . 'general/404.php';
//            }
        }

        static private function setAlias(): void
        {
            self::$aliases = [
                'about::index' => 'main::about',
                'contacts::index' => 'main::contacts',
                'photo::index' => 'main::photo',
            ];
        }

        static private function parseAlias(): void
        {
            $current = self::$controller . '::' . self::$method;
            foreach (self::$aliases as $match => $replace) {
                if ($match != $current) continue;
                [self::$controller, self::$method] = explode('::', $replace);
                return;
            }
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