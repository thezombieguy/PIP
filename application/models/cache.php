<?php

class Cache extends Model
{

  public $basepath = '/cache';
  
  //constructor
  public function __construct() 
  {
    $this->basepath = $_SERVER['DOCUMENT_ROOT'] .'/static/cache/';
  }
  //get data from cache files
  public function get($id) 
  {
    $filename = $this->basepath.'cache_' . $id;
    $cache = array();
    $html = @file_get_contents($filename);
    if (!$html) 
    {
      return $cache;
    }
    else 
    {
      $cache['html'] = $html;
      $cache['time'] = filemtime($filename);
    }
    return $cache;
  }
  
  //set data in cache files
  public function set($id, $data) 
  {

    $filename = $this->basepath.'cache_' . $id;
    $result = file_put_contents($filename, $data);
    if ($result === FALSE) 
    {
      print("Error when trying to write to $filename, please make sure the dir is writable");
    }
    return $result;
  }
  
  //clear all cache files. don't pick and choose.
  public function clear() 
  {
    $directory = $this->basepath.'';
    $handler = opendir($directory);

    while ($file = readdir($handler)) 
    {
      if ($file != "." && $file != ".." && $file != ".svn") 
      {
        unlink($directory.$file);
      }
    }
    closedir($handler);
    return;
  }

}

?>

