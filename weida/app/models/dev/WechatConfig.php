<?php
namespace WZApp\Model;
use Phalcon\Mvc\Model;

class WechatConfig extends Model
{
	public $id;
	public $status;
	public $created_at;
	public $updated_at;
	public $name;
    public $username;
    public $password;
    public $pm_name;
    public $pm_tel;
    public $qrcode;
    public $app_id;
    public $app_secret;
    public $check_file;
    public $service_token;
    public $EncodingAESKey;
    public $from;
    public $call_back_url;


	public function initialize()
    {
        $this->setSource("wd_wechat_config");
        $this->useDynamicUpdate(true);
    }


 

    public function beforeCreate()
    {
        $this->created_at = date('Y-m-d H:i:s');
       // $this->company_no = 'JG'.time().rand(1000,9999);
    }


    public function afterCreate()
    {

        $this->service_token =  'TOKEN'.time().rand(1000,9999);
        $this->EncodingAESKey = time().md5($this->service_token);
        $this->call_back_url =  "http://wd.weizhong360.cn/wechat-call_back?id=".$this->id;
        $res = $this->save();
        if($res){
            dd($this->getMessages());
        }
    }

    public function beforeSave()
    {
        
        $this->updated_at = date("Y-m-d H:i:s");
    }


    
    
}