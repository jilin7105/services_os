<?php
	use Phalcon\Mvc\Router;
	use WZApp\Model\Router as mrouter;
	$router = new Router();

	$router->addGet("/", "index::index");

	$routers = mrouter::find();
	foreach ($routers as $key => $value) {
		$router->add($value->url, "$value->controllers::$value->action");
	}