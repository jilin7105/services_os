<?php
namespace WZApp\Model;
use Phalcon\Mvc\Model;

class Router extends Model
{
	public $id;
	public $status;
	public $created_at;
	public $updated_at;
	public $desc;
    public $url;
    public $action;
    public $name;
    public $type;
    public $request_demo;
    public $response_demo;
	public function initialize()
    {
        $this->setSource("wd_router");
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