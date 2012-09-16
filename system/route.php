<?php

  class Route
  {
    
    /*
     *  Matches the current url with any routes in the config file and remaps the url
     *
     * @param   array  $route   an array containing routing information
     * @param   string  $url  the url you wish to match your routing with
     * @return  string  $url  the remapped url, or existing url is no match was found
     */
    function map($route, $url = '')
    {
      if(!empty($route)){
	      foreach($route as $path => $redirect){
	        if($path == $url){//only matches exact paths.
	          return $redirect;
	        }
	      }
	    }
	    
	    return $url;
	    
    }
    
    

  }

?>
