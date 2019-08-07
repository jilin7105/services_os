<?php

$loader = new \Phalcon\Loader();
if (ENVIRONMENT == 'dev') {

	//命名空间设置
	$loader->registerNamespaces(
	    array(
	      
	       "WZApp\\Help"=>APP_PATH."/help",
	       "WZApp\\Model"=>APP_PATH."/models/dev/"
	    )
	);

    $dirs = array(
        $config->application->controllersDir . 'dev/',
        $config->application->controllersDir,
        $config->application->modelsDir . 'dev/',
        $config->application->modelsDir,
    );
} else {
	//命名空间设置
	$loader->registerNamespaces(
	    array(
	      
	       "WZApp\\Help"=>APP_PATH."/help",
	       "WZApp\\Model"=>APP_PATH."/models/"
	    )
	);
    $dirs = array(
        $config->application->controllersDir,
        $config->application->modelsDir,
    );
}

$loader->registerDirs($dirs)->register();

