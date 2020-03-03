<?php

spl_autoload_register(function ($className) {
    $namespace = str_replace("\\","/",__NAMESPACE__);
    $url = '../'. (empty($namespace)?"":$namespace . "/") . $className . '.php';
    if(file_exists($url)) {
        require_once($url);
        return;
    }
});

$app = new app\App();
$app->run();