<?php

class Main extends Controller {
	
	public function index()
	{
		$this->load->plugin('utils');

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
	  
	}
    
}

?>
