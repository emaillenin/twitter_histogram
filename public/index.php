<?php

date_default_timezone_set('UTC');
require_once __DIR__ . '/../app/bootstrap.php';

use TwitterHistogram\TwitterTimelineService;

$app = new Silex\Application();

$app->get('/histogram/{user}', function($user) use($app) {
    return $app->json((new TwitterTimelineService($user))->getTweetsByHour());
});

$app->run();
