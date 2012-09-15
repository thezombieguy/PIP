<?php

  class http_model extends Model
  {
    
    public function setContext($context)
    {
      $stream_options = array();
      $http = array();

      if(!empty($context))
      {
        
        $http['method'] = !empty($context['method']) ? $context['method'] : 'POST';
        if(!empty($context['header'])){
          $http['header'] = '';
          foreach($context['header'] as $header){
            $http['header'] .= $header. "\r\n";
          }
        }
        $http['header'] .= (!empty($context['user']) && !empty($context['pass'])) ?'Authorization: Basic ' . base64_encode($context['user'].':'.$context['pass']). "\r\n" : '';
        $http['content'] = !empty($context['content']) ? $context['content'] : '';
        $stream_options['http'] = $http;
        
        return $stream_options;  
      }
    }
    
    public function request($url, $data = array())
    {
      $context  = stream_context_create($data);
      $response = file_get_contents($url, null, $context);
      return $response;
    }
  }

?>
