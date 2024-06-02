<?php

    namespace Controller;

    use Core\ModelStorage;
    use Core\Section;
    use Core\View;
    use Model\Users;

    class Main extends \Core\Controller
    {
        private View $view;
        private ModelStorage $model;

        private Users $users;
        public function __construct()
        {
            parent::__construct();
            $this->view = new View();
            $this->model = new ModelStorage();

            $this->users = $this->model->get('Users');
        }

        public function index(): void
        {
            /** @var Users $users */ $users = $this->model->get('Users');
            $name = $this->users->getName();
            $surname = $users->getSurname();
            Section::append('header', $this->view->getContent('components/menu'));
            Section::append('content', $this->view->getContent('general/main'));
            Section::append('content', "Имя: {$name}; Фамилия: {$surname}");
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