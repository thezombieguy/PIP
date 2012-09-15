<?php

  class http_model extends Model
  {
    
    /*
    $context = array(
      'content' => $data,
      'user' => 'guest',
      'pass' => 'guest',
      'header' => array(
        'Content-type: text/xml',//can have as many header values as you need.
      )
    );
    */
    public function setContext($context)
    {
      $stream_options = array();
      $http = array();

      if(!empty($context))
      {
        
        $http['method'] = !empty($context['method']) ? $context['method'] : 'POST';
        
        //lets get some headers
        if(!empty($context['header'])){
          $http['header'] = '';
          foreach($context['header'] as $header){
            $http['header'] .= $header. "\r\n";
          }
        }
        //if user/pass is set, we automatically create an authorization header request
        $http['header'] .= (!empty($context['user']) && !empty($context['pass'])) ?'Authorization: Basic ' . base64_encode($context['user'].':'.$context['pass']). "\r\n" : '';
        $http['content'] = !empty($context['content']) ? $context['content'] : '';
        $stream_options['http'] = $http;
        
        return $stream_options;  
      }
      return;
    }
    
    public function request($url, $data = array())
    {
      $context  = stream_context_create($data);
      $response = file_get_contents($url, null, $context);
      return $response;
    }
  }

?>
