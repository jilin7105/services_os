<?php
use Phalcon\Di\FactoryDefault;

error_reporting(E_ALL);

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

try {

    require APP_PATH . "/assfun/devhelperfun.php";
    $config_basedir =APP_PATH.'/config/';
    require $config_basedir.'ip.php';
    
    $host = Phalcon\Arr::get($_SERVER, 'SERVER_ADDR', '127.0.0.1');


    if(in_array($host,$ip['dev'])){
        define('ENVIRONMENT', 'dev');
    }else if(in_array($host,$ip['test'])){
        define('ENVIRONMENT', 'test');
    }else if(in_array($host,$ip['prod'])){
        define('ENVIRONMENT', 'prod');
    }

 
   
    /**
     * The FactoryDefault Dependency Injector automatically registers
     * the services that provide a full stack framework.
     */
    $di = new FactoryDefault();

    /**
     * Read services
     */
    require APP_PATH . "/config/services.php";

    /**
     * Get config service for use in inline setup below
     */
    $config = $di->getConfig();

    
   

    /**
     * Include Autoloader
     */
    require APP_PATH . '/config/loader.php';


    $di->set('view', function () use ($config) {
        $view = new \Phalcon\Mvc\View();
        if (ENVIRONMENT == 'dev') {
            $dirs = array(
                $config->application->viewsDir . 'dev/',
                $config->application->viewsDir,
            );
        } else {
            $dirs = $config->application->viewsDir;
        }

        $view->setBasePath($dirs);
        return $view;
    }, true);

    if (ENVIRONMENT == 'prod') {
        $di->set('modelsMetadata', function() {
            $metaData = new \Phalcon\Mvc\Model\Metadata\Files(array(
                'metaDataDir' => __DIR__ . DIRECTORY_SEPARATOR . '../apps/cache/metadata/'
             ));
             return $metaData;
        }, true);
    }
    /**
     * Handle the request
     */

    $application = new \Phalcon\Mvc\Application($di);

    echo $application->handle()->getContent();

} catch (\Exception $e) {
    echo $e->getMessage() . '<br>';
    echo '<pre>' . $e->getTraceAsString() . '</pre>';
}
