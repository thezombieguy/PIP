<?php

class Url_helper {

  /*
   * Returns the base url
   *
   * @return  string The base url
   */
	function base_url()
	{
		global $config;
		return $config['base_url'];
	}
	
  /*
   * Returns a segment of the url
   *
   * @param integer $seg  the segment identifier
   * @return  string  $url  The contoller/action/parameter value of the url segment
   */
	function segment($seg)
	{
		if(!is_int($seg)) return false;
		
		$parts = explode('/', $_SERVER['REQUEST_URI']);
	  return isset($parts[$seg]) ? $parts[$seg] : false;
	}
	
	/*
	 * Returns path as formatted html anchor tag
	 * 
	 * @param string  $path the controller/action path you are linking to
	 * @param string  $title  the title of the path.
	 * @param   array $attributes the extra attributes for this anchor tag
	 * @return  string  the html formatted anchor tag
	 */
	function l($path, $title, $attributes = array()) 
  {
    global $config;
    $att = array();
    foreach($attributes as $attribute => $value){
      $att[] = $attribute .'="' . $value.'"';
    }
    return '<a href="'.$config['base_url'] . $path.'" '. implode(' ', $att) .'>'.$title.'</a>';
  }
  
  /*
   * Returns the current url
   *
   * @return  string  $url  The current url
   */
  function url()
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
