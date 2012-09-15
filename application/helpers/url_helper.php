<?php

class Url_helper {

	function base_url()
	{
		global $config;
		return $config['base_url'];
	}
	
	function segment($seg)
	{
		if(!is_int($seg)) return false;
		
		$parts = explode('/', $_SERVER['REQUEST_URI']);
	    return isset($parts[$seg]) ? $parts[$seg] : false;
	}
	
	function l($path, $title) 
  {
    global $config;
    return '<a href="'.$config['base_url'] . $path.'">'.$title.'</a>';
  }
  
  function getUrl()
  {
    $url = '';
    // Get request url and script url
	  $request_url = (isset($_SERVER['REQUEST_URI'])) ? $_SERVER['REQUEST_URI'] : '';
	  $script_url  = (isset($_SERVER['PHP_SELF'])) ? $_SERVER['PHP_SELF'] : '';
      	
	  // Get our url path and trim the / of the left and the right
	  if($request_url != $script_url) $url = trim(preg_replace('/'. str_replace('/', '\/', str_replace('index.php', '', $script_url)) .'/', '', $request_url, 1), '/');
	  
	  return $url;
  }
	
}

?>
