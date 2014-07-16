<?php

  abstract class Controller {
	
	  public $load;

	  /**
	   * abstract index. Requires pages to have indexes.
	   */
	  abstract public function index($args);

	  public function __construct()
	  {
	    $this->load = new Load();
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
