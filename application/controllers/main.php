<?php

class Main extends Controller {
	
	public function index()
	{

		$template = $this->load->view('main_view');
		$url = $this->load->helper('Url_helper');
		$menu = $this->load->helper('menu_helper');
    $items = $menu->load('test_menu') ;

		$template->set('nav', $menu->build($items));
		$template->set('content', $url->l('test', 'Welcome to PIP (modified)', array('id' => 'main')));
		$template->render();
	}
	
  public function cron()
	{
	  $cache = $this->load->model('Cache_model');
	  $cache->set('cron_main', 'testing cron from main class' . time());
	}
    
}

?>
