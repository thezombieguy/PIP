<?php

class Session_helper {

	function set($key, $val)
	{
		$_SESSION["$key"] = $val;
	}
	
	function get($key)
	{
		return !empty($_SESSION["$key"]) ? $_SESSION["$key"] : NULL;
	}
	
	function destroy()
	{
		session_destroy();
	}

}

?>
