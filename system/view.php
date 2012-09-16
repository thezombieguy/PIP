<?php

  class View {

	  private $pageVars = array();
	  private $template;

    /*
     *  Matches the current url with any routes in the config file and remaps the url
     *
     * @param   string  $template   an array containing routing information
     * @return  void
     */
    public function __construct($template)
	  {
		  $this->template = APP_DIR .'views/'. $template .'.php';
	  }

    /*
     *  Set vars in a view template
     *
     * @param   string  $var   the php variable you want to set
     * @param   string  $val   the value you want to assign to the var. This may also be an array, object, integer etc.
     * @return  void
     */	  
	  public function set($var, $val)
	  {
		  $this->pageVars[$var] = $val;
	  }

    /*
     * Render the view template
     *
     * @return  void
     */	 
	  public function render()
	  {
		  extract($this->pageVars);

		  ob_start();
		  require($this->template);
		  echo ob_get_clean();
	  }
	  
    /*
     * Fetch the view template for use in php variables
     *
     * @return  string  $contents The php template 
     */	 	
	  public function fetch()
    {
      extract($this->pageVars);

      ob_start();
      require($this->template);
      $contents = ob_get_contents();
      ob_end_clean();
      return $contents;
    }

      
  }

?>
