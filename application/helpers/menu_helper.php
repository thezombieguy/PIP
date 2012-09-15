<?php

class Menu_helper
{
  public function build($items)
  {
    $nav = '<ul>';
    foreach($items as $item){
      if(isset($item['children'])){
        $nav .= $this->build($item['children']);
      }
      $nav .= '<li><a href="'.$item['url'].'">'.$item['title'].'</a></li>';
    }
    $nav .= '</ul>';
    
    return $nav;
  }
}

?>
