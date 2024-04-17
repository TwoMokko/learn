<?php

    namespace Controller;

    class User extends \Core\Controller
    {
        public function __construct()
        {
            parent::__construct();
            echo 'init ';
        }

        public function index(): void
        {
            die('index');
        }

        public function create(): void
        {
            die('create');
        }

        public function update(): void
        {
            die('update');
        }
    }