<?php

namespace Core;

class View extends Buffer
{
    public function getContent($path): string
    {
        self::start();
        require DIR_VIEWS . $path . '.tpl';
        return self::get();
    }
}