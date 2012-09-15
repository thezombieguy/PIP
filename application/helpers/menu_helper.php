<?php

class Menu_helper
{
  private $load;
  
  public function build($items)
  {
    $nav = '<ul>';
    
    foreach($items as $item){
      
      $nav .= '<li class="nav"><a href="'.$item['url'].'">'.$item['title'].'</a>';
      $nav .= isset($item['children']) ? $this->build($item['children']) : NULL;
      $nav .= '</li>';
      
    }
    $nav .= '</ul>';
    
    return $nav;
  }
}

?>
