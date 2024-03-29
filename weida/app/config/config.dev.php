<?php
/*
 * Modified: preppend directory path of current file, because of this file own different ENV under between Apache and command line.
 * NOTE: please remove this comment.
 */
defined('BASE_PATH') || define('BASE_PATH', getenv('BASE_PATH') ?: realpath(dirname(__FILE__) . '/../..'));
defined('APP_PATH') || define('APP_PATH', BASE_PATH . '/app');
defined('UPLOAD_PATH') || define('UPLOAD_PATH', BASE_PATH . '/uploads/');
return new \Phalcon\Config([
    'database' => [
        'adapter'     => 'Mysql',
        'host'        => '47.95.214.178',
        'username'    => 'www',
        'password'    => 'Weizhong2018!@#',
        'dbname'      => 'weida',
        'charset'     => 'utf8',
    ],
    'application' => [
        'appDir'         => APP_PATH . '/',
        'controllersDir' => APP_PATH . '/controllers/',
        'modelsDir'      => APP_PATH . '/models/',
        'migrationsDir'  => APP_PATH . '/migrations/',
        'viewsDir'       => APP_PATH . '/views/',
        'pluginsDir'     => APP_PATH . '/plugins/',
        'libraryDir'     => APP_PATH . '/library/',
        'cacheDir'       => BASE_PATH . '/cache/',
        'baseUri'        => '/weida/',
   
    ],
    'service_type' =>[
        "1"=>"系统服务",
        "2"=>"api管理"
    ]
  
]);
