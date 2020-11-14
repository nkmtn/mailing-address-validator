<?php

require __DIR__ . '/vendor/autoload.php';

use Console\App\Commands\ValidatorCommand;
use Symfony\Component\Console\Application;

$app = new Application();

$app->add(new ValidatorCommand());

try {
    $app->run();
} catch (Exception $e) {
}
