<?php

class Main extends Controller {
	
	function index()
	{
		$template = $this->load->view('main_view');
		$url = $this->load->helper('Url_helper');
		$menu = $this->load->helper('menu_helper');
		
		$links = array(
        array(
          'title' => 'Home',
          'url' => '',
        ),
        array(
          'title' => 'Test',
          'url' => 'test',
        ),
      );
        
		$template->set('nav', $menu->build($links));
		$template->set('content', $url->l('test', 'Welcome to PIP (modified)', array('id' => 'main')));
		$template->render();
	}
    
}

?>
