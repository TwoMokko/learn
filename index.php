<?php
    const DIR_ROOT = __DIR__ . '/';
    const DIR_BASE = DIR_ROOT . 'base/';
    const DIR_LAYOUT = DIR_ROOT . 'layout/';
    const DIR_PAGES = DIR_ROOT . 'pages/';

    define('ADDRESS', "{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['SERVER_NAME']}");

    session_start();

    require DIR_ROOT . 'functions.php';
    require DIR_BASE . 'controller.php';
    require DIR_BASE . 'layout.php';
    require DIR_BASE . 'response.php';

    User::init();

    \Base\Controller::setPage();
    \Base\Controller::redirect();

    require DIR_LAYOUT . 'main.php';
