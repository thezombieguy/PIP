<?php

  class Cache_model extends Model
  {

    public $basepath = '';
    
    /*
     * Set up the base path for the cache templates. This folder needs write permissions.
     *
     * @return  void
     */	 
    public function __construct() 
    {
      global $config;
      $this->basepath = !empty($config['cache_folder']) ? $config['cache_folder'] : ROOT_DIR .'/static/cache/';
    }

    /*
     * Retrieve a cached items
     *
     * @param   string  $id The unique identifier of the cahced item
     * @return  object  $cache  The cached object, or an empty object if no cache object exists
     */
    public function get($id) 
    {
      $filename = $this->basepath.'cache_' . $id;
      $cache = (object)array('html' => '', 'time' => 0);
      $html = @file_get_contents($filename);
      if (!$html) 
      {
        return $cache;
      }
      else 
      {
        $cache->html = $html;
        $cache->time = filemtime($filename);
      }
      return $cache;
    }
    
    /*
     * Cache an object
     *
     * @param   string  $id The unique identified of this cached object
     * @param   string  $data A string of data you want to cache. Can be html, serialized array etc.
     * @return  boolean $result reurns if the object was cached or not.
     */
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
    
    /*
     * Clears every cached object. Be careful, there's no pick and choose here.
     *
     * @return  void
     */
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

