<?php
/*
 * PIP v0.5.3
 */

// Defines
define('ROOT_DIR', realpath(dirname(__FILE__)) .'/');
define('APP_DIR', ROOT_DIR .'application/');

require(APP_DIR .'config/config.php');
require(ROOT_DIR .'system/autoload.php');

// Define base URL
global $config;
define('BASE_URL', $config['base_url']);

//Start the Session
session_start();

//initialize
$pip = new Pip();

?>
