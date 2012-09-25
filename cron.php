<?php
/*
 * Cron class
 *
 * Execute cron hooks when run. Set up a cron job to wget this file in order to run your cron hooks.
 *
 * @author Bryan Trudel https://github.com/thezombieguy
 * @package PIP
 */
  class Cron
  {
    public $load;
    public $reset = 3600;//1hr. this should be in config.
    
    /*
     * initialize cron. 
     */
    public function __construct()
    {
    
      $this->load = new Load();//for loading cache
      $cache = $this->load->model('Cache_model');
      $reset = $cache->get('cron_reset');
      
      //time to run cron?
      if(time() > ($reset->time+$this->reset) || empty($reset->time))
      {
        $this->runCron();
        //the cron timer should go into the DB. using cache for now to avoid db call.
        $cache->set('cron_reset', 'reset');
      }
    
    }
    
    /*
     * returns path to find cron hooks in.
     *
     * @return  array paths for cron hooks
     */
    private function cronDirs()
    {
      return array(
        APP_DIR . 'controllers/',
      );
    }
    
    /*
     * run the cron hooks.
     *
     * @return void
     */
    private function runCron()
    {
      //echo 'running cron';
      foreach($this->cronDirs() as $dir)
      {
        if (is_dir($dir)) 
        {
          if ($dh = opendir($dir)) {
           while (($file = readdir($dh)) !== false) 
            {
              if(preg_match('/\.php/', $file))
              {
                $f = explode('.', $file);
                $class = $f[0];
                if(method_exists($class, 'cron'))
                {
                  $cron = new $class;
                  $cron->cron();
                }
              }
            }
            closedir($dh);
          }
        }
      }//foreach
    }
    
  }
  //Go speed racer!
  include('bootstrap.php');
  $cron = new Cron();
?>


