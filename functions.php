<?php

    require 'users/User.php';

    use JetBrains\PhpStorm\NoReturn;

    #[NoReturn] function redirect(string $location = ADDRESS): void {
        header("Location: {$location}");
        die;
    }

    function debug(mixed $variable): void {
        echo '<pre>'; var_dump($variable); echo '</pre>';
    }

    #[NoReturn] function dd(mixed $variable): void {
        debug($variable);
        die;
    }
