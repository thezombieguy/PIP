<?php

  class Route
  {
    
    function __construct() 
    {
      //empty.
    }
    
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
