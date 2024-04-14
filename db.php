<?php
    class DB {
        private static mysqli|bool $db;
        private static array $history;

        public static function connect(): void {
            self::$db = mysqli_connect('localhost', 'root', '', 'notice');
            if (!self::$db) die('data base error');
        }

        public static function getHistory(): array {
            return self::$history;
        }

        public static function getLastQuery(): string {
            return self::$history[count(self::$history) - 1];
        }

        public static function showLastQuery(): void {
            echo self::getLastQuery();
        }

        public static function showLastQueryAndDie(): void {
            self::showLastQuery();
            die;
        }

        public static function query(string $sql): bool|mysqli_result {
            self::$history[] = $sql;
            return mysqli_query(self::$db, $sql);
        }

        public static function getUserByLogin(string $login): ?array {
            $login = mysqli_real_escape_string(self::$db, $login);
            $result = self::query("SELECT `login`, `password`, `salt`, `token` FROM `users` WHERE `login` = '{$login}'");

            return mysqli_fetch_assoc($result);
        }

        public static function getUserByLoginAndToken(string $login, string $token): ?array {
            $login = mysqli_real_escape_string(self::$db, $login);
            $token = mysqli_real_escape_string(self::$db, $token);
            $result = self::query("SELECT `login` FROM `users` WHERE `login` = '{$login}' AND `token` = '{$token}'");

            return mysqli_fetch_assoc($result);
        }

        public static function createUser(string $login, string $pass, string $salt, string $token): bool {
            $login = mysqli_real_escape_string(self::$db, $login);
            $pass = mysqli_real_escape_string(self::$db, $pass);
            $token = mysqli_real_escape_string(self::$db, $token);

            return self::query("INSERT INTO `users` (`login`, `password`, `salt`, `token`) VALUES ('{$login}', '{$pass}', '{$salt}','{$token}')");
        }

        public static function issetUserByLogin(string $login): bool {
            $login = mysqli_real_escape_string(self::$db, $login);
            $result = self::query("SELECT `login` FROM `users` WHERE `login` = '{$login}'");

            return (bool)mysqli_fetch_assoc($result);
        }
    }
