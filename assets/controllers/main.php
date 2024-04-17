<?php

    namespace Controller;

    use Core\Section;
    use Core\Template;

    class Main extends \Core\Controller
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function index(): void
        {
//            Template::set('xxx');
            Section::append('content', '<div>Главная</div>');
        }

        public function about(): void
        {
            Section::append('content', '1 sdhfcsdf<br>');
            Section::append('content', '2 suidhfyusdtf<br>');
            Section::append('content', '3 suidhfyusdtf<br>');
            Section::append('header', 'menu');
        }

        public function update(): void
        {

        }
    }