<?php

require_once __DIR__ . '/../vendor/autoload.php';

$env = getenv('APP_ENV') ?: 'dev';
$string = file_get_contents(__DIR__ . "/../app/config/$env.json");
$config = json_decode($string, true);

define('TWITTER_CONSUMER_KEY', $config['twitter']['TWITTER_CONSUMER_KEY']);
define('TWITTER_CONSUMER_SECRET', $config['twitter']['TWITTER_CONSUMER_SECRET']);
define('TWITTER_ACCESS_TOKEN', $config['twitter']['TWITTER_ACCESS_TOKEN']);
define('TWITTER_ACCESS_TOKEN_SECRET', $config['twitter']['TWITTER_ACCESS_TOKEN_SECRET']);

require_once __DIR__. '/src/services/TwitterTimelineService.php';
require_once __DIR__. '/src/services/TweetIteratorService.php';