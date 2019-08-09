<?php
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Smarty;

// $di->setShared('view', function() {
//     $view = new \Phalcon\Mvc\View();
//     $config = $this->getConfig();
//     if (ENVIRONMENT == 'dev') {
//             $dirs = array(
//                 $config->application->viewsDir . 'dev/',
//                 $config->application->viewsDir,
//             );
//         } else {
//             $dirs = $config->application->viewsDir;
//         }

//     $view->setBasePath($dirs);
//     //$v = new \Phalcon\Mvc\View\Engine\Volt\Compiler();
//     $view->registerEngines([
//         // '.phtml' => '\Phalcon\Mvc\View\Engine\Php',
//         // '.volt' => function($view, $di) use ($config) {
//         //     $volt = new ViewVoltEngine($view, $di);
 
//         //     $volt->setOptions(['compiledPath'       => $config->application->cacheDir . 'view/',
//         //                         'compiledExtension' => '.compiled',
//         //                         'compileAlways'     => true
//         //     ]);
 
//         //     $compiler = $volt->getCompiler();
//         //     $compiler->addFilter('floor', 'floor');
//         //     $compiler->addFunction('range', 'range');
 
//         //     return $volt;
//         // },
//         \Phalcon\Mvc\View\Engine\Twig::DEFAULT_EXTENSION => function ($view, $di) {
//             return new \Phalcon\Mvc\View\Engine\Twig($view, $di, [
//                 'cache' =>$this->getConfig()->application->cacheDir,
//             ]);
//         }
//     ]);
 
//     return $view;
// });

$di->set(
    'view',
    function () use ($config) {
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
        $view->registerEngines(
            [
            	'.phtml' => '\Phalcon\Mvc\View\Engine\Php',
                // '.html' => function ($view, $di) {
                //     $smarty = new Smarty($view, $di);

                //     $smarty->setOptions(
                //         [
                //             'template_dir'    => $view->getViewsDir(),
                //             'compile_dir'     => '../app/viewscompiled',
                //             'error_reporting' => error_reporting() ^ E_NOTICE,
                //             'escape_html'     => true,
                //             '_file_perms'     => 0666,
                //             '_dir_perms'      => 0777,
                //             'force_compile'   => false,
                //             'compile_check'   => true,
                //             'caching'         => false,
                //             'debugging'       => true,
                //         ]
                //     );

                //     return $smarty;
                // }
            ]
        );

        return $view;
    }
);