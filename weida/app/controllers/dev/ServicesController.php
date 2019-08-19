<?php
use WZApp\Model\Services;

class ServicesController extends ControllerBase
{
 	public function showAddAction()
    {
       	
    	
    }

    public function addAction(){
    	$input = $this->request->get();      
       	$service = new Services();
       	$res = $service->create($input);

	    if(!$res){
	        dd($service->getMessages());
	    }
    	redirect('/');
      
    }
}

