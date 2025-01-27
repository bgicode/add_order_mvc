<?php

/** @var \Core\Application $app */
use App\Сontrollers;
use App\Controllers\BaseController;

$app->router->get('/', [\App\Controllers\HomeController::class, 'index']);
$app->router->post('/', [\App\Controllers\HomeController::class, 'addOrder']);
$app->router->get('order', [\App\Controllers\OrderController::class, 'openOrder']);
$app->router->get('user', [\App\Controllers\UserController::class, 'openUser']);
