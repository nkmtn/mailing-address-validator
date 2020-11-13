<?php

require __DIR__ . '/vendor/autoload.php';

use App\Command\MetricsCommand;
use Symfony\Component\Console\Application;

$app = new Application();

$app->add(new MetricsCommand());

$app->run();
