<?php
use WZApp\Model\Services;

class IndexController extends ControllerBase
{
 	public function indexAction()
    {
        $this->view->setVar("services",Services::find(['order'=>"id desc"]));

    }

    public function route404Action(){
    	
    }
}

