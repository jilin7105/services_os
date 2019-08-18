<?php

use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;

class ControllerBase extends Controller
{
	public $response;
	public $use_common_template = true;
	public function initialize()
    {
    	
    	$this->view->setTemplateAfter('common');
    	
    	
        $this->response = new Response();
    }


}
