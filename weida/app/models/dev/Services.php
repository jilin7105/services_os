<?php
namespace WZApp\Model;
use Phalcon\Mvc\Model;

class Services extends Model
{
	public $id;
	public $name;
	public $created_at;
	public $updated_at;
    public $url;
    public $type;
    public $has_open_api;
    public $ser_desc;
	public function initialize()
    {
        $this->setSource("wd_service");
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