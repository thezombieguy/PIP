<?php
/*
 * Autoload class
 *
 * Registers autoload clallback.
 *
 * @author Bryan Trudel https://github.com/thezombieguy
 * @package Pip
 */
class Autoload {

  private $callback;  
  
  /*
   * initiates the autoload.
   */
  public function __construct()
  {
    $this->callback = array($this, 'autoload');
    $this->register();
  }
  
  /*
   * Registers the autoload function
   * 
   * @return array $this callback for autoload
   */
  private function register()
  {
    spl_autoload_register($this->callback);
    return $this;
  }
  
  /*
   * load a class
   *
   * @param string  $class  the class you want to load
   * @return  void
   */
  private function autoload($class)
  {
    global $config;
    
    //this needs sepoerate configuration. But will go here for now. Default application settings.
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
