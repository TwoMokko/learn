<?php

    namespace Core;

    abstract class Controller {
        public function __construct()
        {

        }

        static public function init(string $controller, string $method): void {
            self::upload($controller);
            self::extract($controller, $method);
        }

        static private function upload(string $controller): void {
            require DIR_CONTROLLERS . $controller . '.php';
        }

        static private function extract(string $controller, string $method): void {
            $controllerPath = '\Controller\\' . $controller;
            $classController = new $controllerPath();
            call_user_func([$classController, $method]);
        }
    }