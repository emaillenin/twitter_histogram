<?php

date_default_timezone_set('UTC');
require_once __DIR__ . '/../vendor/autoload.php';
require '../app/src/services/TwitterTimelineService.php';

$app = new Silex\Application();
$env = getenv('APP_ENV') ?: 'prod';
$app->register(new Igorw\Silex\ConfigServiceProvider(__DIR__ . "/../app/config/$env.json"));

$app->get('/histogram/{user}', function($user) use($app) {
    return $app->json((new TwitterTimelineService($user))->getTweetsByHour());
});

$app->run();
