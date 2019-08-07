<?php
	use Phalcon\Mvc\Router;

	$router = new Router();

	$router->addGet("/", "index::index");
