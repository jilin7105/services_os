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

    public function infoAction(){
       $id = $this->request->get('id'); 
       $router = Router::findFirst($id);
       $this->view->setVar("router",$router);

    }
    public function deleteAction(){
    	$id = $this->request->get('id'); 
    	$router = Router::findFirst($id);
    	$router->status = 0;
    	$router->save();

    	$this->response->redirect('/router-list', true , 301);
    
    }
    public function addAction()
    {

    	$input = $this->request->get();      
       	$router = new Router();
       	$res = $router->create($input);

	    if(!$res){
	        dd($router->getMessages());
	    }
    	$this->response->redirect('/router-list', true , 301);
      

    }

    public function updateAction(){
      $input = $this->request->get();
      $router = Router::findFirst($input['id']);
      $router->update($input );
      $this->response->redirect('/router-list', true , 301);
    }

}

