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
		//dd($value->url, "$value->controllers::$value->action");
		$router->add($value->url, "$value->controllers::$value->action");
	}

	$router->notFound(
	    array(
	        "controller" => "index",
	        "action"     => "route404"
	    )
	);