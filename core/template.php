<?php

namespace Core;

class Template
{
    static public string $layout = 'default';



    static public function init(): void {
        require DIR_LAYOUTS . self::$layout . '.tpl';
    }

    static public function set(string $layout): void {
        self::$layout = $layout;
    }
}