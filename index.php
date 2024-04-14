<?php

    const DIR_ROOT = __DIR__ . '/';
    const DIR_CORE = DIR_ROOT . 'core/';
    const DIR_ASSETS = DIR_ROOT . 'assets/';
    const DIR_CONTROLLERS = DIR_ASSETS . 'controllers/';
    const DIR_MODELS = DIR_ASSETS . 'models/';
    const DIR_VIEWS = DIR_ASSETS . 'templates/views/';
    const DIR_LAYOUTS = DIR_ASSETS . 'templates/layouts/';
    const DIR_SECTIONS = DIR_ASSETS . 'templates/sections/';

    define('ADDRESS', "{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['SERVER_NAME']}");

    session_start();

    require DIR_CORE . 'functions.php';
    require DIR_CORE . 'controller.php';
    require DIR_CORE . 'router.php';
    require DIR_CORE . 'response.php';

    require DIR_ASSETS . 'functions.php';

    require DIR_ROOT . 'db.php';

    DB::connect();

    core\Router::run();
