<?php

  class Controller {
	
	  public $load;

	  public function __construct()
	  {
	    $this->load = new Load();
	  }
	
	  /*
	   * Redirects to a new url
	   *
	   * @param   string  $loc  URL to recirect to 
	   * @return  void
	   */
    public function redirect($loc)
	  {
		  global $config;
		
		  header('Location: '. $config['base_url'] . $loc);
	  }

	  /*
	   * Provides a basic JSON response header. Useful for providing ajax data.
	   *
	   * @param 	object 	$data 	A string, array, or object of data to encode.
	   */
	  public function json($data = '')
	  {
	  	header('Content-type: application/json');
	  	print json_encode($data);
	  	exit();
	  }
      
  }

?>
