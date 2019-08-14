<?php
use WZApp\Model\Services;
use WZApp\Model\Router;

class RouterController extends ControllerBase
{
 	public function showAddAction()
    {
       	
    	
    }

    public function listAction(){
       $router = Router::find(["status = :status:",'bind'=>['status'=>1]]);
       $this->view->setVar("routers",$router);
       
    }

    public function deleteAction(){
    	$id = $this->request->get('id'); 
    	$router = Router::findFrist($id);
    	$router->status = 0;
    	$router->save();
    	$this->response->redirect('/router-list');

    }
    public function addAction()
    {

    	$input = $this->request->get();      
       	$router = new Router();
       	$res = $router->create($input);

	    if(!$res){
	        dd($router->getMessages());
	    }
    	$this->response->redirect('/router-list');

    }


}

