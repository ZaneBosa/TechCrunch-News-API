<?php

require_once "vendor/autoload.php";

use App\Controllers\NewsController;
use App\Views\TwigView;
use App\Services\ShowAllArticlesService;
use App\Repositories\NewsApiArticlesRepository;
use App\Repositories\NewsRepository;

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', 'App\Controllers\NewsController@show');
    $r->addRoute('GET', '/articles/create', 'App\Controllers\NewsController@show');
});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        echo "Not Found";
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        echo "Invalid Method";
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];

        [$controller, $method] = explode('@', $handler);


        /** @var TwigView $view */

        $loader = new \Twig\Loader\FilesystemLoader('app/Views');
        $twig = new \Twig\Environment($loader);

        $container = new \DI\Container();
        $container->set(NewsRepository::class, DI\create(NewsApiArticlesRepository::class));

        $view = ($container->get($controller))->$method();

        $template = $twig->load($view->getTemplatePath());
        echo $template->render($view->getData());

        break;
}
