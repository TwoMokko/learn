<?php

    namespace Model;

    use Core\Model;

    class Users extends Model
    {
        public function getName(): string {
            return 'Den';
        }

        public function getSurname(): string {
            return 'Goman';
        }
    }