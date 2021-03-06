<?php
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	
	set_include_path("core/config/". PATH_SEPARATOR ."core/models/". PATH_SEPARATOR ."core/view/". PATH_SEPARATOR ."core/conrtoller/";
	
	$params = array();
    if($config['host'] && strpos($_SERVER['REQUEST_URI'], $config['host'])){
        $uri = trim(substr($_SERVER['REQUEST_URI'], strpos($_SERVER['REQUEST_URI'], $config['host']) + strlen($config['host'])), '/');
    } else {
        $uri = trim($_SERVER['REQUEST_URI'], '/');
    }
    if($uri) {
        $params = explode('/', $uri);
    }
	
	
    $className = null;
    if(isset($params[0])) {
        $controller_name = ucfirst($params[0]);
        $className = "{$controller_name}Controller";
    } else {
        $className = "SiteController";
    }
    session_start();
    $_SESSION['config'] = $config;
    include "$className.php";

    $action = 'index';
    $controller = new $className();

    if(isset($params[1])) {
        $actionName = mb_strtolower(explode('?', $params[1])[0]);
        if(method_exists($className, $actionName."Action")) {
            $action = $actionName;
        }
    }

    $controller->{"{$action}Action"}();