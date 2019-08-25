<?php
namespace WZApp\Help;
use Phalcon\Http\Response;
use WZApp\Model\WechatConfig;
class WechatHelper 
{	
	public $config 
	
	static protected $ins = null;

	public static function init($id)
	{
		$config = WechatConfig::findFirst($id);
		if(self::$ins){
			self::$ins->config  = $config;

		}else{
			self::$ins = new self($config);
		}
		return self::$ins;
	}

	protected function __construct($config){
        $this->config = $config;
    }


}