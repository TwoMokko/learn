<?php

    namespace Core;

    class ModelStorage
    {
        private static /** @var Model[] */ array $models = [];

        static public function append(Model $model): void {
            self::$models[$model->getNameModel()] = $model;
        }

        public function get(string $class, string $alias = ''): Model {
            $name = $alias ?: $class;
            if (!isset(self::$models[$name])) {
                self::$models[$name] = Model::init($class, $name);
            }
            return self::$models[$name];
        }
    }