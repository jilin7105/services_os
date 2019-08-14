<?php
use WZApp\Model\Services;
use WZApp\Model\Router;
class RouterController extends ControllerBase
{
 	public function showAddAction()
    {
       	
    	
    }

    public function listAction(){

    }

    public function addAction()
    {
    	$input = $this->request->get();      
       	$router = new Router();
       	$res = $router->create($input);
       	

    	
    }


}

