<?php
use WZApp\Model\WechatConfig;

class WechatController extends ControllerBase
{
	public function initialize()
    {
    	$this->use_common_template = false;
    	
    }
 	public function indexAction(){
       
       	$this->view->setVar("wechats", WechatConfig::find());

    }

    public function showaddAction(){

    }


    public function addAction(){
    	$input = $this->request->getPost();
    	dd($input,$this->request->getUploadedFiles());
    }


    public function updateStatusAction(){
        $id = $this->request->get('id'); 
        $wc = WechatConfig::findFirst((int)$id);
        $wc->status = $wc->status == 0 ?1:0;
        $wc->save();

        redirect('/');
    }




}

