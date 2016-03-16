<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\ClassLoader\ClassLoader;

$loader = new ClassLoader();

$loader->setUseIncludePath(true);
$loader->addPrefix("", __DIR__. './src/services/');

$loader->register();

return $loader;
