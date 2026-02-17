<?php

use app\controllers\ApiExampleController;
use app\controllers\BesoinController;
use app\controllers\BesoinVilleController;
use app\controllers\DonController;
use app\controllers\UniteController;
use app\controllers\VilleController;
use app\middlewares\SecurityHeadersMiddleware;
use app\controllers\AchatController;
use flight\Engine;
use flight\net\Router;

/**
 * @var Router $router
 * @var Engine $app
 */

// This wraps all routes in the group with the SecurityHeadersMiddleware
$router->group('', function (Router $router) use ($app) {

    $router->get('/', function () use ($app) {
        $app->render('dashboard');
    });

    $router->get('/villes', [VilleController::class, 'renderAll']);

    $router->get('/acheter-besoin', [AchatController::class, 'renderAll']);
    $router->get("/recap", [BesoinVilleController::class, 'recapitulatif']);
    $router->get('/declare-besoin', [BesoinVilleController::class, 'InfoForBesoinDeclaration']);
    $router->get('/api/unite/@id_objet', [BesoinController::class, 'getUniteForObject']);
    $router->get("/ville-besoin/@id", [VilleController::class, 'renderBesoinByVille']);
    $router->get('/donate', [UniteController::class, 'getAll']);
    $router->post('/acheter', [AchatController::class, 'acheter']);

    $router->get('/dash', [BesoinVilleController::class, 'getVilleBesoin']);

    $router->get('/dispatches', function () use ($app) {
        $app->render('dispatches');
    });

    $router->get('/hello-world/@name', function ($name) {
        echo '<h1>Hello world! Oh hey ' . $name . '!</h1>';
    });

    $router->post('/donate', [DonController::class, 'insert']);
    $router->post('/add-besoin', [BesoinVilleController::class, 'insert']);

    $router->group('/api', function () use ($router) {
        $router->get('/users', [ApiExampleController::class, 'getUsers']);
        $router->get('/users/@id:[0-9]', [ApiExampleController::class, 'getUser']);
        $router->post('/users/@id:[0-9]', [ApiExampleController::class, 'updateUser']);
    });

    $router->get('/dispatch', [DonController::class, 'dispatch']);
    $router->get('/simuler-dispatch', [DonController::class, 'simulerDispatch']);

}, [SecurityHeadersMiddleware::class]);