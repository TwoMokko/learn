<?php

    namespace Core;

    use JetBrains\PhpStorm\NoReturn;

    class Response {
        const STATE_ERROR   = 'error';
        const STATE_OK      = 'ok';

        #[NoReturn] static public function send(string $json): void {
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header('Content-Type: application/json; charset=utf-8');;
            die($json);
        }

        #[NoReturn] static public function sendData(array $data): void {
            self::send(json_encode($data));
        }

        #[NoReturn] static public function sendError(string $error = 'ошибка доступа'): void {
            $data = [
                'state' => self::STATE_ERROR,
                'body' => [
                    'message' => $error
                ]
            ];
            self::sendData($data);
        }

        #[NoReturn] static public function sendOk(mixed $body = null): void {
            $data = [
                'state' => self::STATE_OK,
                'body' => $body
            ];
            self::sendData($data);
        }
    }