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

