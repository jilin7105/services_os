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



    public function beforeSave()
    {
        
        $this->updated_at = date("Y-m-d H:i:s");
    }


    
    
}