<?php
/*
 * Menu_helper class
 *
 * A very basic menu helper to help build out list item menus.
 *
 * @author Bryan Trudel https://github.com/thezombieguy
 */
class Menu_helper
{
  
  /*
   * Build a menu from an array
   * 
   * @param   array $items  an array of menu items
   * @return  string  $nav  a rendered menu
   */
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
  
  
  /*
   * Fetch the predefined menu
   *
   * @return  array  $menu the predefine menu iarray 
   */	 	
  public function load($menu_id)
  {
    require(APP_DIR.'config/menus.php');
    return (!empty($menu[$menu_id])) ? $menu[$menu_id] : null;
  }
  
}

?>
