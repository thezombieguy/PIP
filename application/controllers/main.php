<?php

class Main extends Controller {
	
	function index()
	{
		$template = $this->load->view('main_view');
		$url = $this->load->helper('Url_helper');
		$template->set('content', $url->l('test', 'Test'));
		$template->render();
	}
    
}

?>
