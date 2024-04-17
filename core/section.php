<?php

    namespace Core;

    abstract class Section
    {
        protected static array $sections = [];

        public static function append(string $section, string $content): void {
            static::$sections[$section][] = $content;
        }

        public static function show(string $section): void {
            if (!isset(static::$sections[$section])) return;
            foreach (static::$sections[$section] as $content) echo $content;
        }
    }