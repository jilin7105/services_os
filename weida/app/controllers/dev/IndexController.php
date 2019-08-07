<?php
use WZApp\Model\Services;

class IndexController extends ControllerBase
{

    public function indexAction()
    {
    	$ser = Services::find(["status = :status:",'bind'=>['status'=>1]]);
    	$this->view->setVar('ser',$ser);
    	 $this->view->pick('index/index');
    }

}

