<?php
/*
 * PIP v0.5.3
 */

// Defines
define('ROOT_DIR', realpath(dirname(__FILE__)) .'/');
define('APP_DIR', ROOT_DIR .'application/');
require(APP_DIR .'config/config.php');

// Define base URL
global $config;
define('BASE_URL', $config['base_url']);

//autoload
function __autoload($class) 
{
  global $config;
  $paths = array(
    ROOT_DIR .'system/',
    APP_DIR . 'controllers/',
    APP_DIR . 'helpers/',
    APP_DIR . 'models/',
    APP_DIR . 'plugins/',
  );

  foreach($paths as $path){
    if(file_exists($path . strtolower($class) . '.php')) {
      require_once($path . strtolower($class) . '.php');
    }
  }
}

//Start the Session
session_start(); 

$pip = new Pip();

?>
