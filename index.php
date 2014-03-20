<?php

//----------------------------------------------------------------------------
// Global App Constants
//----------------------------------------------------------------------------

define('APP_PATH', dirname(__FILE__));

define('APP_FOLDER', dirname($_SERVER['SCRIPT_NAME']));

define('APP_URI', preg_replace('#(?<!:)//#', '/', 'http://'.$_SERVER['SERVER_NAME'].APP_FOLDER.'/'));

define('SYS_PATH', APP_PATH.'/system');

//----------------------------------------------------------------------------
// Initialization
//----------------------------------------------------------------------------

require_once SYS_PATH.'/core/Autoloader.php';

Core\Autoloader::add(array(
    'Controller\\' => SYS_PATH.'/controllers',
    'Model\\' => SYS_PATH.'/models',
    'Core\\' => SYS_PATH.'/core',
    'Lib\\' => SYS_PATH.'/lib',
));
Core\Autoloader::register();

Core\Session::start();

Core\Config::load(SYS_PATH.'/config/config.php');

if(Core\Config::get('debug'))
{
	ini_set('display_errors', 1);
    error_reporting(E_ALL^E_STRICT);
}
else
{
	ini_set('display_errors', 0);
    error_reporting(0);
}

date_default_timezone_set(Core\Config::get('timezone'));

Core\Application::run(new Core\Dispatcher($_SERVER['REQUEST_URI'])); // Run app