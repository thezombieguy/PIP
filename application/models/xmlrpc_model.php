<?php

  class xmlrpc_model extends Model
  {

    private $user;
    private $pass;
    private $url;
    private $connect = false;
    
    
    public function set($connection)
    {
      if(!empty($connection)){
        global $conf;
        $this->user = $conf['xmlrpc'][$connection]['username'];
        $this->pass = $conf['xmlrpc'][$connection]['password'];
        $this->url = $conf['xmlrpc'][$connection]['url'];
        $this->connect = true;
      }
    }
    
    
    public function request($data)
    {
      if($this->connect){
        
        $auth = '';
        
        if(!empty($this->user) && !empty($this->pass)){
          $auth = 'Authorization: Basic ' . base64_encode($this->user.':'.$this->pass). "\r\n";
        }
        //this could be a setContext function. 
        //for simplicity, its always post, xml, data.
        $stream_options = array(
          'http' => array(
            'method'  => 'POST',
            'header'  => 'Content-type: text/xml' . "\r\n" . $auth,          
            'content' =>  $data,
          )
        );

        $context  = stream_context_create($stream_options);
        $response = file_get_contents($this->url, null, $context);

        return $response;
      }
      else
      {
        print "xmprpc request error: No connection data defined in \$conf";
      }
    }
    
  }

?>
