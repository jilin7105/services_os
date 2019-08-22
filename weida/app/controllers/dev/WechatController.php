<?php
use WZApp\Model\WechatConfig;
use WZApp\Help\FileHelper;
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
    	//dd($input);
    	$file = new FileHelper();
    	$upload_file = $file->Upload($this->request);
    	foreach ($upload_file as $key => $value) {
    		$input[$key] = $value['showpath'];
    	}

    	$wc = new WechatConfig();
    	$res = $wc->create($input);
    	if(!$res){

	        dd($router->getMessages());
	    }else{
	    	
	       
	        $wc->call_back_url =  "http://wd.weizhong360.cn/wechat-call_back?id=".$wc->id;
	        $res = $wc->save();
	        if($res){
	            dd($wc->getMessages());
	        }
	    }
    	redirect('/wechat');
    }


    public function updateStatusAction(){
        $id = $this->request->get('id'); 
        $wc = WechatConfig::findFirst((int)$id);
        $wc->status = $wc->status == 0 ?1:0;
        $wc->save();

        redirect('/wechat');
    }

    





}

