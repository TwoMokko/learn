<?php
    class DB {
        private static array $users = [
            ['id' => 1, 'login' => 'qwerty1', 'password' => 'pass1', 'name' => 'Ivan', 'old' => 43, 'token' => '7db06879fcc5dd6ea3443b5f870a0b234ced19077591445a3a1b562279893c21'],
            ['id' => 2, 'login' => 'qwerty2', 'password' => 'pass2', 'name' => 'Oleg', 'old' => 23, 'token' => 'f1ffe713fe06cbc77e579967515e8c88af5b65be5bb723a64d089d3fc1ef7af9'],
            ['id' => 3, 'login' => 'qwerty3', 'password' => 'pass3', 'name' => 'Denis', 'old' => 46, 'token' => '9fbc821a945f93ec90948848d486cf37b63f7098c7b88e7e26d85a41e280fa9f'],
            ['id' => 4, 'login' => 'qwerty4', 'password' => 'pass4', 'name' => 'Vova', 'old' => 23, 'token' => '09beafdacbaae6543f8dcfe4c5c36ce0229daf1460f34fe9ec2ff5cbf07e2110'],
            ['id' => 5, 'login' => 'qwerty5', 'password' => 'pass5', 'name' => 'Ira', 'old' => 23, 'token' => '449d2dd071039ffbf33f12f7b8900bf5709f60bee60eea06a9d3a1d12e641bdd'],
        ];

        public static function getUserByLoginAndPass(string $login, string $pass): ?array {
            foreach (self::$users as $user) {
                if ($user['login'] === $login && $user['password'] === $pass) return $user;
            }
            return null;
        }

        public static function getUserByLoginAndToken(string $login, string $token): ?array {
            foreach (self::$users as $user) {
                if ($user['login'] === $login && $user['token'] === $token) return $user;
            }
            return null;
        }
    }
