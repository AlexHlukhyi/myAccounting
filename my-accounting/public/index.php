<?php

//autoloader for not using autorun.php everywhere
//not ready yet
spl_autoload_register(function ($className) {
    $directories = array(
        '../app/',
        '../app/controllers/',
        '../app/model/',
        '../app/view/',
        '../config/',
        '../database/'
    );
    foreach($directories as $directory) {
        if(file_exists($directory . $className . '.php')) {
            require_once($directory . $className . '.php');
            return;
        }
    }
});

$app = new Application\App();
$app->run();