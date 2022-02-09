<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$capsule = new Capsule;
$capsule->addConnection([
    "driver" => "pgsql",
    "host" => $_ENV["POSTGRES_HOST"],
    "database" => $_ENV["POSTGRES_DB"],
    "username" => $_ENV["POSTGRES_USER"],
    "password" => $_ENV["POSTGRES_PASSWORD"]
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();
