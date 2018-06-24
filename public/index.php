<?php
/**
 * Created by PhpStorm.
 * User: kniko
 * Date: 2018. 06. 20.
 * Time: 15:53
 */
session_start();
define( 'URL_ROOT', 'http://localhost/criterion-login');
define( 'VIEWS_DIR', '/app/views/');

require_once '../config/DB.php';
require_once '../config/Router.php';

spl_autoload_register(function ($name) {
	if (file_exists( '../app/controllers/' . $name .'.php' )){
		require_once '../app/controllers/' . $name  .'.php';
	}
	else if (file_exists( '../app/models/' . $name  .'.php' )){
		require_once '../app/models/' . $name  .'.php';
	}
});

$router = new Router();

$router->addRoute('', [ 'controller' => 'HomeController', 'action' => 'index']);
$router->addRoute('login', [ 'controller' => 'UserController', 'action' => 'login']);
$router->addRoute('logout', [ 'controller' => 'UserController', 'action' => 'logout']);
$router->addRoute('register', [ 'controller' => 'UserController', 'action' => 'register']);
$router->addRoute('profile', [ 'controller' => 'UserController', 'action' => 'profile']);

$url = $_SERVER['QUERY_STRING'];

$router->dispatch($url);
