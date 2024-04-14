<?php

    use JetBrains\PhpStorm\NoReturn;

    function debug(mixed $variable): void {
        echo '<pre>'; var_dump($variable); echo '</pre>';
    }

    #[NoReturn] function dd(mixed $variable): void {
        debug($variable);
        die;
    }
