<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

error_reporting(E_ALL);
ini_set("display_errors", 1);

require __DIR__ . '/../vendor/autoload.php';

// Create Router instance
$router = new \Bramus\Router\Router();

$router->setNamespace('Controllers');

// routes for the games endpoint
$router->get('/games', 'GameController@getAll');
$router->get('/games/(\d+)', 'GameController@getOne');
$router->post('/games', 'GameController@create');
$router->put('/games/(\d+)', 'GameController@update');
$router->delete('/games/(\d+)', 'GameController@delete');

// routes for the categories endpoint
$router->get('/categories', 'CategoryController@getAll');
$router->get('/categories/(\d+)', 'CategoryController@getOne');
$router->post('/categories', 'CategoryController@create');
$router->put('/categories/(\d+)', 'CategoryController@update');
$router->delete('/categories/(\d+)', 'CategoryController@delete');

// routes for user_games endpoint
$router->get('/user_games', 'User_gameController@getAll');
$router->get('/user_games/(\d+)', 'User_gameController@getOne');
$router->post('/user_games', 'User_gameController@create');
$router->put('/user_games/(\d+)', 'User_gameController@update');
$router->delete('/user_games/(\d+)', 'User_gameController@delete');

// routes for messages endpoint
$router->get('/messages/(\d+)', 'MessageController@getAll');
//$router->get('/messages/(\d+)', 'MessageController@getOne');
$router->post('/messages', 'MessageController@create');
$router->put('/messages/(\d+)', 'MessageController@update');
$router->delete('/messages/(\d+)', 'MessageController@delete');

// routes for login endpoint
$router->post('/users/login', 'UserController@login');
$router->post('/users/register', 'UserController@register');
// Run it!
$router->run();