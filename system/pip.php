<?php
/*
 * Pip class
 *
 * Loads the framework. MVC core.
 *
 * @author Original (base functionality) Gilbert Pellegrom https://github.com/gilbitron
 * @author Bryan Trudel https://github.com/thezombieguy
 * @package PIP
 */
  class Pip {
  
    /*
     * initialize the controller/action method
     *
     * we are using the autoloader method, so class includes have been removed.
     */
    public function __construct()
    {
	    
	    global $config;
      
      $url = $this->url();
	    $segments = explode('/', $url);

	    $method = $this->controllerValidate(
	      array(
          'controller' => (isset($segments[0]) && ($segments[0] != '')) ? $segments[0] : $config['default_controller'],
          'action' => (isset($segments[1]) && $segments[1] != '') ? $segments[1] : 'index',
        )
      );
	    
	    $controller = $method['controller'];
	    $action = $method['action'];

	    $obj = new $controller;
        die(call_user_func_array(array($obj, $action), array_slice($segments, 2)));
    }
    
    /*
     * Retrieves the url for parsing controller/action methods
     *
     * @return  string  $url  the url path with routing method
     */
    private function url()
    {
      global $route; 
      
      $url = '';

	    $request_url = (isset($_SERVER['REQUEST_URI'])) ? $_SERVER['REQUEST_URI'] : '';
	    $script_url  = (isset($_SERVER['PHP_SELF'])) ? $_SERVER['PHP_SELF'] : '';

	    if($request_url != $script_url) 
	    {
	      $url = trim(preg_replace('/'. str_replace('/', '\/', str_replace('index.php', '', $script_url)) .'/', '', $request_url, 1), '/');
      }
      $router = new Route();
      $url = $router->map($route, $url);
      return $url;
    }
    
    /*
     * validates the controller / method and defaults to error controller
     *
     * @param   array $method The controller/action pair in an array
     * @return  array $method controller with error defaults if controller/action doesn't exist
     */
    private function controllerValidate($method) 
    {
      global $config;

      $path = APP_DIR . 'controllers/' . $method['controller'] . '.php';
      
      if(!file_exists($path)){
        $method['controller'] = $config['error_controller'];
      }
      
      if(!method_exists($method['controller'], $method['action'])){
        $method['controller'] = $config['error_controller'];
        $method['action'] = 'index';
      }
      
      return $method;
    }
    
  }
?>
