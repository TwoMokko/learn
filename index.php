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

    require_once DIR_CORE . 'functions.php';
    require_once DIR_CORE . 'controller.php';
    require_once DIR_CORE . 'router.php';
    require_once DIR_CORE . 'response.php';
    require_once DIR_CORE . 'section.php';
    require_once DIR_CORE . 'template.php';
    require_once DIR_CORE . 'buffer.php';
    require_once DIR_CORE . 'view.php';
    require_once DIR_CORE . 'model.php';
    require_once DIR_CORE . 'modelStorage.php';

    require_once DIR_ASSETS . 'functions.php';

    require_once DIR_ROOT . 'db.php';

    DB::connect();

    core\Router::run();
