<?php

use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;

class ControllerBase extends Controller
{
	public $response;
	public function initialize()
    {
    	$this->view->setTemplateAfter('common');
        $this->response = new Response();
    }


}
