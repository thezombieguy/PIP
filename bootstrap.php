<?php

// Defines
define('ROOT_DIR', realpath(dirname(__FILE__)) .'/');
define('APP_DIR', ROOT_DIR .'application/');

require(APP_DIR .'config/config.php');
require(ROOT_DIR .'system/autoload.php');

// global vars
global $config;
global $routes;

//Start the Session
session_start();

//autoload
Autoload::getInstance();
