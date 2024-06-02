<?php

    namespace Core;

    abstract class Model
    {

        private string $name;
        public function __construct(string $name)
        {
            $this->name = $name;
            ModelStorage::append($this);
        }

        public function getNameModel(): string {
            return $this->name;
        }

        static public function init(string $class, string $name): self {
            self::upload($class);
            return self::extract($class, $name);
        }

        static private function upload(string $class): void {
            require DIR_MODELS . $class . '.php';
        }

        static private function extract(string $class, string $name): self {
            $modelPath = '\Model\\' . $class;
            return new $modelPath($name);
        }
    }