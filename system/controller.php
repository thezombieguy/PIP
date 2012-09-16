<?php

  class Controller {
	
	  public $load;

	  public function __construct()
	  {
	    $this->load = new Load();
	  }
	
	  /*
	   * Recirects to a new url
	   *
	   * @param   string  $loc  URL to recirect to 
	   * @return  void
	   */
    public function redirect($loc)
	  {
		  global $config;
		
		  header('Location: '. $config['base_url'] . $loc);
	  }
      
  }

?>
