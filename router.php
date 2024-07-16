<?php

use Controllers\TaskController;
use Framework\Router;

$router = new Router();

$router->get('/', [TaskController::class, 'index']);
$router->get('/tasks', [TaskController::class, 'index']);
$router->get('/tasks/create', [TaskController::class, 'create']);
$router->post('/tasks', [TaskController::class, 'store']);
$router->get('/tasks/edit/{id}', [TaskController::class, 'edit']);
$router->post('/tasks/update/{id}', [TaskController::class, 'update']);
$router->get('/tasks/delete/{id}', [TaskController::class, 'delete']);

$router->put('/tasks/{id}', [TaskController::class, 'update']);
$router->delete('/tasks/{task}', [TaskController::class, 'delete']);

$router->handle();
