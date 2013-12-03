<?php
/*
 * Router class
 * 
 * reroute a selected path to a new controller/action as specified in $route configuration
 *
 * @author Bryan Trudel https://github.com/thezombieguy
 * @package PIP
 */
  class Route
  {
    
    /*
     * Matches the current url with any routes in the config file and remaps the url. 
     * Uses basic pattern matching to replace variables in routes. 
     *
     * @param   array  $route   an array containing routing information
     * @param   string  $url  the url you wish to match your routing with
     * @return  string  $url  the remapped url, or existing url is no match was found
     * @todo  expand to use smarter url matching for parameters. 
     */
    function map($route, $url = '')
    {
      if(!empty($route))
      {
	      foreach($route as $path => $redirect)
        {
          $path = $this->match($path);//let's replace the patters here.
          $map = preg_match(','.$path.',', $url, $pmatches);//and create a map.

          //if there's a match
          if(!empty($pmatches))
          {
            //provides a basic url match/replace. Nothing fancy this time round.
            array_shift($pmatches);//first part is not useful
            $tmp = preg_match_all(',:(.*?):,', $redirect, $mat);//get all the matching params from route
            $url = str_replace(':', '', preg_replace($mat[0], $pmatches, $redirect));//and replace into the redirect params
          }
	      }
	    }
	    return $url;
	    
    }

    /*
     * Matching function to parse out the parameters of your route, and replace with regex patterns.
     * 
     * @param   string  $string   the route you want to parse
     * @return  string  $string   the regex replaced string pattern, or original string. 
     * @todo: Expand usage to match patterns for restrictive parameter types. :int: = integer etc..
     * Parameters are agnostic. Only digits and numbers allowed. 
     * Anything between semi colons. :val: or :id:. We are not restricting params to certain types.
     * 
     */
    function match($string) 
    {
      $string = preg_replace(',:(.*?):,', '([0-9A-Za-z]+)', $string);
      return $string;
    }
    
    

  }

?>
