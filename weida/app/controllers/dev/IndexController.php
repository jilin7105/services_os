<?php
use WZApp\Model\Services;

class IndexController extends ControllerBase
{
 	public function indexAction()
    {
        $this->view->setVar("services",Services::find(["status = :status:","bind"=>['status'=>1]]));

    }

}

