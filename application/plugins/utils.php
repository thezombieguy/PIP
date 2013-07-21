<?php

  /*
   * This plugin file is loaded as a core PIP file. Core loading functionality can be added/removed here.
   */
  
  /*
   * Advanced var_dump / print_r function.
   *
   * @param   $data string/int/array to print out
   * @return  void  prints out the formatted results.  
   */
  function print_rr($data)
  {
    print "<pre>";
    var_dump($data);
    print "</pre>";
  }
  /*
   * Function to encode plain text for safe html use
   * 
   * @param string  $text text string to make plain text
   * @return  string  $text Clean html safe string.
   */
  function plain_text($text) {
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
  }


?>
