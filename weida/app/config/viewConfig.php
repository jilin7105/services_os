<?php
$di->setShared('view', function() {
    $view = new \Phalcon\Mvc\View();
    $config = $this->getConfig();
    if (ENVIRONMENT == 'dev') {
            $dirs = array(
                $config->application->viewsDir . 'dev/',
                $config->application->viewsDir,
            );
        } else {
            $dirs = $config->application->viewsDir;
        }

    $view->setBasePath($dirs);
    //$v = new \Phalcon\Mvc\View\Engine\Volt\Compiler();
    $view->registerEngines([
        // '.phtml' => '\Phalcon\Mvc\View\Engine\Php',
        // '.volt' => function($view, $di) use ($config) {
        //     $volt = new ViewVoltEngine($view, $di);
 
        //     $volt->setOptions(['compiledPath'       => $config->application->cacheDir . 'view/',
        //                         'compiledExtension' => '.compiled',
        //                         'compileAlways'     => true
        //     ]);
 
        //     $compiler = $volt->getCompiler();
        //     $compiler->addFilter('floor', 'floor');
        //     $compiler->addFunction('range', 'range');
 
        //     return $volt;
        // },
        \Phalcon\Mvc\View\Engine\Twig::DEFAULT_EXTENSION => function ($view, $di) {
            return new View\Engine\Twig($view, $di, [
                'cache' =>$this->getConfig()->application->cacheDir,
            ]);
        }
    ]);
 
    return $view;
});
