<?php

date_default_timezone_set('UTC');
require_once __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();
$env = getenv('APP_ENV') ?: 'prod';
$app->register(new Igorw\Silex\ConfigServiceProvider(__DIR__."/../config/$env.json"));

$app->get('/', function() use($app) {
    return 'Try /hello/:name';
});

$app->get('/hello/{name}', function($name) use($app) {
    return 'Hello ' . $app->escape($name);
});

$app->run();
