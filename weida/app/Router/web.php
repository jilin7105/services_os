<?php
	use Phalcon\Mvc\Router;
	use WZApp\Model\Router as mrouter;
	$router = new Router(false);

	$router->add("/", "index::index");
	$router->add("/router-showadd", "router::showadd");
	$router->add("/router-add", "router::add");
	$router->add("/router-list", "router::list");
	$routers = mrouter::find();
	foreach ($routers as $key => $value) {
		$router->add($value->url, "$value->controllers::$value->action");
	}