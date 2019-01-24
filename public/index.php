<?php

require __DIR__ . '/../vendor/autoload.php';

use Engine\Request;
use Engine\Response;
use Engine\Database\Queries;
use Engine\Database\Db;
use Engine\Container;
use Engine\RouterEngine;

$config = require __DIR__ . '/../config.php';
Container::attach('config', $config);

Container::attach('Database', new Queries(
    Db::connect(Container::get('config')['database'])
));


$router = new RouterEngine(
    new Request(),
    new Response());
$router->init(__DIR__ . '/../App/routes.php');
