<?php

class Menu_helper
{
  private $load;
  
  public function __construct()
  {
    $load = new Load();
  }
  
  public function build($items)
  {
    $nav = '<ul>';
    
    foreach($items as $item){
      if(isset($item['children'])){
        $nav .= $this->build($item['children']);
      }
      $nav .= '<li class="nav"><a href="'.$item['url'].'">'.$item['title'].'</a></li>';
    }
    $nav .= '</ul>';
    
    return $nav;
  }
}

?>
