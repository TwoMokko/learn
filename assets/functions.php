<?php

    use JetBrains\PhpStorm\NoReturn;

    #[NoReturn] function redirect(string $location = ADDRESS): void {
        header("Location: {$location}");
        die;
    }
