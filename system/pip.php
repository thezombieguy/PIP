<?php

  function pip()
  {
	  global $config;
    global $route; 

    $url = '';

	  // Get request url and script url
	  $request_url = (isset($_SERVER['REQUEST_URI'])) ? $_SERVER['REQUEST_URI'] : '';
	  $script_url  = (isset($_SERVER['PHP_SELF'])) ? $_SERVER['PHP_SELF'] : '';
      	
	  // Get our url path and trim the / of the left and the right
	  if($request_url != $script_url) $url = trim(preg_replace('/'. str_replace('/', '\/', str_replace('index.php', '', $script_url)) .'/', '', $request_url, 1), '/');
	
	  //lets check if we are routing anything here.
    $router = new Route();
    $url = $router->map($route, $url);
	
	  // Split the url into segments
	  $segments = explode('/', $url);

	  // Set our defaults, Do our default checks
	  $controller = (isset($segments[0]) && ($segments[0] != '')) ? $segments[0] : $config['default_controller'];
	  $action = (isset($segments[1]) && $segments[1] != '') ? $segments[1] : 'index';

	  // Get our controller file
    $path = APP_DIR . 'controllers/' . $controller . '.php';
    
	  if(file_exists($path)){
          require_once($path);
	  } else {
          $controller = $config['error_controller'];
          require_once(APP_DIR . 'controllers/' . $controller . '.php');
	  }
      
      // Check the action exists
      if(!method_exists($controller, $action)){
          $controller = $config['error_controller'];
          require_once(APP_DIR . 'controllers/' . $controller . '.php');
          $action = 'index';
      }
	
	  // Create object and call method
	  $obj = new $controller;
      die(call_user_func_array(array($obj, $action), array_slice($segments, 2)));
  }

?>
