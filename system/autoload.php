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
  private static $instance; 
  
  /*
   * initiates the autoload.
   */
  public function __construct()
  {
    $this->callback = array($this, 'autoload');
    $this->register();
  }
  
  /*
   * Get singleton instance
   */
  function getInstance()
  {
    if(!self::$instance){
    
      self::$instance = new Autoload();
      
    }
        
    return self::$instance;
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
    
    $paths = $config['autoload_paths'];

    foreach($paths as $path){
      if(file_exists($path . strtolower($class) . '.php')) {
        require_once($path . strtolower($class) . '.php');
      }
    }
  }
}

?>
