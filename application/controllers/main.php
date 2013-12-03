<?php

class Main extends Controller 
{
	  
  public function __construct()
  {
    parent::__construct();    
  }
	
	public function index($args)
	{
		$template = $this->load->view('main_view');
		$template->set('content', Url_helper::l('test', 'Welcome to PIP (modified)', array('id' => 'main')));
		$template->render();
	}
    
}

?>
