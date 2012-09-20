<?php

class Autoload {

  public $callback;  
  
  public function __construct()
  {
    $this->callback = array($this, 'autoload');
  }
  
  public function getCallback()
  {
    print_r($this->callback);
  }
  
  public function register()
  {
    spl_autoload_register($this->callback);
    return $this;
  }
  
  public function autoload($class)
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
}

?>
