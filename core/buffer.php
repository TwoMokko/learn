<?php

namespace Core;

abstract class Buffer
{
    static protected function start(): void {
        ob_start();
    }

    static protected function get(): string {
        $content = ob_get_contents();
        ob_end_clean();
        return $content ?: '';
    }
}