<?php

class Menu_helper
{
  
  public function build($items)
  {
    global $config;
    
    $nav = '<ul>';
    
    foreach($items as $index => $item){
    
      $nav .= '<li class="nav"><a href="'.$config['base_url'] . $item['url'].'">'.$item['title'].'</a>';
      $nav .= isset($item['children']) ? $this->build($item['children']) : NULL;
      $nav .= '</li>';
      
    }
    $nav .= '</ul>';
    
    return $nav;
  }
  
  public function current()
  {
  
  }
}

?>
