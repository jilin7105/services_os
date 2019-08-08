<?php
use WZApp\Model\Services;

class IndexController extends ControllerBase
{
 	public function indexAction()
    {
        $this->view->phrase = 'World!';
    }

}

