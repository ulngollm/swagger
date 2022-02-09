<?php

require "vendor/autoload.php";
require "bootstrap.php";

use Slim\Factory\AppFactory;

$app = AppFactory::create();

require_once './routes.php';

$app->addErrorMiddleware(true, true, true);

$app->run();


