<?php

use App\Redirect;
use App\Repositories\Product\MysqlProductRepository;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Type\MysqlTypeRepository;
use App\Repositories\Type\TypeRepository;
use App\View;
use FastRoute\Dispatcher;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once 'vendor/autoload.php';

//Possible to change data source using dependency injections (e.g. switch from MysqlProductRepository to CSVProductRepository)
$builder = new DI\ContainerBuilder();
$builder->addDefinitions([
    ProductRepository::class => DI\create(MysqlProductRepository::class),
    TypeRepository::class => DI\create(MysqlTypeRepository::class),
]);
$container = $builder->build();

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {

    $r->addRoute('GET', '/', ['App\Controllers\ProductsController', 'index']);
    $r->addRoute('GET', '/add-product', ['App\Controllers\ProductsController', 'add']);
    $r->addRoute('POST', '/add-product', ['App\Controllers\ProductsController', 'getType']);
    $r->addRoute('POST', '/add-product/validate', ['App\Controllers\ProductsController', 'store']);
    $r->addRoute('POST', '/delete', ['App\Controllers\ProductsController', 'delete']);

});

function fetchMethodAndURIFromSomewhere(Dispatcher $dispatcher, $container): void
{
    $httpMethod = $_SERVER['REQUEST_METHOD'];
    $uri = $_SERVER['REQUEST_URI'];

    if (false !== $pos = strpos($uri, '?')) {
        $uri = substr($uri, 0, $pos);
    }
    $uri = rawurldecode($uri);

    $routeInfo = $dispatcher->dispatch($httpMethod, $uri);
    switch ($routeInfo[0]) {
        case FastRoute\Dispatcher::NOT_FOUND:
            break;
        case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
            $allowedMethods = $routeInfo[1];
            break;
        case FastRoute\Dispatcher::FOUND:
            $controller = $routeInfo[1][0];
            $method = $routeInfo[1][1];
            $vars = $routeInfo[2];

            $response = (new $controller($container))->$method($vars);

            $loader = new FilesystemLoader('app/Views');
            $twig = new Environment($loader);

            if ($response instanceof View) {
                echo $twig->render($response->getPath(), $response->getVariables());
            }

            if ($response instanceof Redirect) {
                header('Location: ' . $response->getLocation());
                exit;
            }

            break;
    }
}

fetchMethodAndURIFromSomewhere($dispatcher, $container);