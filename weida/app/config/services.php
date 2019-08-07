<?php

use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Php as PhpEngine;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Flash\Direct as Flash;

/**
 * Shared configuration service
 */
$di->setShared('config', function () {
    $filename = 'config.php';
    if (ENVIRONMENT == 'dev') {
        $filename = 'config.dev.php';
    }

    if (ENVIRONMENT == 'test') {
        $filename = 'config.test.php';
    }
    return include APP_PATH . "/config/".$filename;
});

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->setShared('url', function () {
    $config = $this->getConfig();

    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);

    return $url;
});







/**
 * Setting up the view component
 */

$di->setShared('view', function (){
    $config = $this->getConfig();

    $view = new View();
    $view->setDI($this);
    //$view->setViewsDir($config->application->viewsDir);
    if (ENVIRONMENT == 'dev') {
            $dirs = array(
                $config->application->viewsDir . 'dev/',
                $config->application->viewsDir,
            );
        } else {
            $dirs = $config->application->viewsDir;
        }

    $view->setBasePath($dirs);
    $view->registerEngines([
        //设置模板后缀名
        //'.phtml' => PhpEngine::class
        '.phtml' => function ($view, $di) use ($config) {
            $volt = new VoltEngine($view, $di);
            $volt->setOptions(array(
                //模板是否实时编译
                'compileAlways' => false,
                //模板编译目录
                'compiledPath' => BASE_PATH.'/cache/compiled/frontend'
            ));
            return $volt;
        },
    ]);

    return $view;
});


/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di->setShared('db', function () {
    $config = $this->getConfig();

    $class = 'Phalcon\Db\Adapter\Pdo\\' . $config->database->adapter;
    $connection = new $class([
        'host'     => $config->database->host,
        'username' => $config->database->username,
        'password' => $config->database->password,
        'dbname'   => $config->database->dbname,
        'charset'  => $config->database->charset
    ]);

    return $connection;
});


/**
 * If the configuration specify the use of metadata adapter use it or use memory otherwise
 */
$di->setShared('modelsMetadata', function () {
    return new MetaDataAdapter();
});

/**
 * Register the session flash service with the Twitter Bootstrap classes
 */
$di->set('flash', function () {
    return new Flash([
        'error'   => 'alert alert-danger',
        'success' => 'alert alert-success',
        'notice'  => 'alert alert-info',
        'warning' => 'alert alert-warning'
    ]);
});


$di->set('router', function () {
    
    include APP_PATH . "/Router/web.php";
    return $router;
});



/**
 * Start the session the first time some component request the session service
 */
$di->setShared('session', function () {
    $session = new SessionAdapter();
    $session->start();

    return $session;
});
