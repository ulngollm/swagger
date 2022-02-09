<?php
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

return
[
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/Database/Migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/Database/Seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'dev',
        'dev' => [
            'adapter' => 'pgsql',
            'host' => $_ENV["POSTGRES_HOST"],
            'name' => $_ENV["POSTGRES_DB"],
            'user' => $_ENV["POSTGRES_USER"],
            'pass' => $_ENV["POSTGRES_PASSWORD"],
            'charset' => 'utf8',
            'port' => 5432,
        ]
    ],
    'version_order' => 'creation'
];
