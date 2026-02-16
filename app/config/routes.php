<?php

use app\controllers\ApiExampleController;
use app\middlewares\SecurityHeadersMiddleware;
use app\controllers\BesoinVilleController;
use flight\Engine;
use flight\net\Router;
use app\controllers\DonController;
use app\controllers\UniteController;

/** 
 * @var Router $router 
 * @var Engine $app
 */

// This wraps all routes in the group with the SecurityHeadersMiddleware
$router->group('', function(Router $router) use ($app) {

	$router->get('/', function() use ($app) {
		$app->render('dashboard');
	});

		$router->get('/declarebesoin', function() use ($app) {
		$app->render('declarebesoin');
	});

	// $router->get('/dash', function() use ($app) {
	// 	$app->render('dashboard');
	// });
	
	$router->get('/dash', function() use ($app) {
		$app->render('dashboard');
	});
	
  $router->get('/donate', function() use ($app) {
		$app->render('donate');
	});
  $router->get('/donate',[ UniteController::class, 'getAll' ]);

	$router->get('/dash', [BesoinVilleController::class, 'getVilleBesoin']);

	$router->get('/hello-world/@name', function($name) {
		echo '<h1>Hello world! Oh hey '.$name.'!</h1>';
	});

	$router->post('/donate', [ DonController::class, 'insert' ]);

	$router->group('/api', function() use ($router) {
		$router->get('/users', [ ApiExampleController::class, 'getUsers' ]);
		$router->get('/users/@id:[0-9]', [ ApiExampleController::class, 'getUser' ]);
		$router->post('/users/@id:[0-9]', [ ApiExampleController::class, 'updateUser' ]);
	});
	
}, [ SecurityHeadersMiddleware::class ]);