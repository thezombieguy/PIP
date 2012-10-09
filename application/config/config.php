<?php 

//some constants
define('SITE_NAME', 'www.example.com');
define('BASE_URL', 'http://'.$_SERVER['HTTP_HOST'].'/');

//$config['base_url'] = 'http://'.$_SERVER['HTTP_HOST'].'/'; // Base URL including trailing slash (e.g. http://localhost/)

$config['default_controller'] = 'main'; // Default controller to load
$config['error_controller'] = 'error'; // Controller used for errors (e.g. 404, 500 etc)

$config['db_host'] = 'localhost'; // Database host (e.g. localhost)
$config['db_name'] = 'portfolio'; // Database name
$config['db_username'] = ''; // Database username
$config['db_password'] = ''; // Database password

//Not recommended to change these defaults. But you may add your own.
$config['autoload_paths'] = array(
      ROOT_DIR .'system/',
      APP_DIR . 'controllers/',
      APP_DIR . 'helpers/',
      APP_DIR . 'models/',
      APP_DIR . 'plugins/',
      //add your paths here
    );
    
//routing.
$route['home'] = 'main';

?>
