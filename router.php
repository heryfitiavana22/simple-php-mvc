<?php

use Controllers\TaskController;
use Framework\Router;

$router = new Router();

$router->get('/', [TaskController::class, 'index']);
$router->get('/tasks', [TaskController::class, 'index']);
$router->get('/tasks/create', [TaskController::class, 'create']);
$router->post('/tasks', [TaskController::class, 'store']);
$router->get('/tasks/edit', [TaskController::class, 'edit']);
$router->post('/tasks/update', [TaskController::class, 'update']);
$router->get('/tasks/delete', [TaskController::class, 'delete']);

$router->handle();

