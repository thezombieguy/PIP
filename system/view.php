<?php

class View {

	private $pageVars = array();
	private $template;

	public function __construct($template)
	{
		$this->template = APP_DIR .'views/'. $template .'.php';
	}

	public function set($var, $val)
	{
		$this->pageVars[$var] = $val;
	}

	public function render()
	{
		extract($this->pageVars);

		ob_start();
		require($this->template);
		echo ob_get_clean();
	}
	
	public function fetch()
  {
    extract($this->pageVars);

    ob_start();
    require($this->template);
    $contents = ob_get_contents();
    ob_end_clean();
    return $contents;
  }

    
}

?>
