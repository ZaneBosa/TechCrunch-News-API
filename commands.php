<?php

use App\Repositories\NewsApiArticlesRepository;
use App\Repositories\NewsRepository;

require_once "vendor/autoload.php";

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$container = new \DI\Container();
$container->set(NewsRepository::class, DI\create(NewsApiArticlesRepository::class));

$commands = [
    'articles' => \App\Console\ArticlesCommand::class
];

$selectedCommand = $argv[1];

$container->get($commands[$selectedCommand])->execute($argv[2]);