<?php
	use Phalcon\Mvc\Router;
	use WZApp\Model\Router as mrouter;
	$router = new Router(false);

	$router->addGet("/", "index::index");
	$router->addGet("/router-showadd", "router::showadd");
	$router->addGet("/router-add", "router::add");
	$routers = mrouter::find();
	foreach ($routers as $key => $value) {
		$router->add($value->url, "$value->controllers::$value->action");
	}