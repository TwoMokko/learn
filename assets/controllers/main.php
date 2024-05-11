<?php

    namespace Controller;

    use Core\Section;
    use Core\View;

    class Main extends \Core\Controller
    {
        private View $view;
        public function __construct()
        {
            parent::__construct();
            $this->view = new View();
        }

        public function index(): void
        {
            Section::append('header', $this->view->getContent('components/menu'));
            Section::append('content', $this->view->getContent('general/main'));
        }

        public function about(): void
        {
            Section::append('header', $this->view->getContent('components/menu'));
            Section::append('content', '1 sdhfcsdf<br>');
            Section::append('content', '2 suidhfyusdtf<br>');
            Section::append('content', '3 suidhfyusdtf<br>');
        }

        public function update(): void
        {

        }
    }