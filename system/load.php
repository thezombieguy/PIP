<?php

  class Load
  {
    /*
     * Loads a model
     *
     * @param   string  $name the name of the model
     * @return  instance  $model  the instance of the model
     */
    public function model($name)
	  {
		  require(APP_DIR .'models/'. strtolower($name) .'.php');

		  $model = new $name;
		  return $model;
	  }
	
   /*
    * Loads a view
    *
    * @param   string  $name  the name of the view
    * @return  instance  $view  the instance of the view
    */
	  public function view($name)
	  {
		  $view = new View($name);
		  return $view;
	  }
	
   /*
    * Loads a plugin
    *
    * @param   string  $name  the name of the plugin
    * @return  void
    */
    	  public function plugin($name)
	  {
		  require(APP_DIR .'plugins/'. strtolower($name) .'.php');
	  }

   /*
    * Loads a helper
    *
    * @param   string  $name  the name of the helper
    * @return  instance  $hlper the instance of the helper
    */	
	  public function helper($name)
	  {
		  require(APP_DIR .'helpers/'. strtolower($name) .'.php');
		  $helper = new $name;
		  return $helper;
	  }
    
  }

?>
