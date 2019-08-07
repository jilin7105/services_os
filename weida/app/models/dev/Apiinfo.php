<?php
namespace WZApp\Model;
use Phalcon\Mvc\Model;

class Apiinfo extends Model
{
	public $id;
	public $status;
	public $created_at;
	public $updated_at;
	public $type;
    public $url;
    public $method;
    public $request;
    public $response;

	public function initialize()
    {
        $this->setSource("wd_apiinfo");
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