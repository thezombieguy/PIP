<?php
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
  class http_model extends Model
  {
    
    /*
     * Create a context option for the http request
     *
     * @return  array $stream_options the array of oiptions to set for teh http request
     */    
    public function setContext($context)
    {
      $stream_options = array();
      $http = array();

      if(!empty($context))
      {
        
        $http['method'] = !empty($context['method']) ? $context['method'] : 'POST';
        
        //loops through headers to created header request information.
        if(!empty($context['header'])){
          $http['header'] = '';
          foreach($context['header'] as $header){
            $http['header'] .= $header. "\r\n";
          }
        }
        //if user/pass is set, we automatically create an authorization header request. This coudl be added to headers dynamically as a header element, rather than user/pass in the context array.
        $http['header'] .= (!empty($context['user']) && !empty($context['pass'])) ?'Authorization: Basic ' . base64_encode($context['user'].':'.$context['pass']). "\r\n" : '';
        $http['content'] = !empty($context['content']) ? $context['content'] : '';
        $stream_options['http'] = $http;
        
        return $stream_options;  
      }
      return;
    }
    
    /*
     * Request information from a url
     *
     * @param string  $url  The url to request information from
     * @param array $data the context array to create the http request for file_get_contents
     * @return  string  $response Information returned from the server. OR bool=false if not successful.
     */    
    public function request($url, $data = array())
    {
      $context  = stream_context_create($data);
      $response = file_get_contents($url, null, $context);
      //needs error checking here.
      return $response;
    }
  }

?>
