<?php
use WZApp\Model\Services;

class IndexController extends ControllerBase
{
 	public function indexAction()
    {
        $this->view->setVar("services",Services::find());

    }

    public function route404Action(){
    	echo "<h1>当前地址未注册</h1>";
    	die;
    }
}

