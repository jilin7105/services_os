<?php
use WZApp\Model\Services;
use WZApp\Model\Router;

class RouterController extends ControllerBase
{
 	public function showAddAction()
    {
       	
    	
    }

    public function listAction(){
       $router = Router::find();
       $this->view->setVar("routers",$router);

    }

    public function deleteAction(){
    	$id = $this->request->get('id'); 
    	$router = Router::findFirst($id);
    	$router->status = 0;
    	$router->save();

    	return $this->response->redirect('/router-list');
      //$this->view->disable();
    }
    public function addAction()
    {

    	$input = $this->request->get();      
       	$router = new Router();
       	$res = $router->create($input);

	    if(!$res){
	        dd($router->getMessages());
	    }
    	return $this->response->redirect('/router-list');
      //$this->view->disable();

    }


}

