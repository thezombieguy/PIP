<?php

  class Model
  {

	  public $load;
	  private $db;

	  public function __construct()
	  {
		  global $config;
		  $this->load = new Load();
		  if(!empty($config['db_host']) && !empty($config['db_username']) && !empty($config['db_password']) && !empty($config['db_name'])){
		    $this->db = mysqli_connect(
		                    $config['db_host'], 
		                    $config['db_username'], 
		                    $config['db_password'], 
		                    $config['db_name']
        ) or die('MySQL Error: '. mysql_error());
		  }
		
	  }

	  public function escapeString($string)
	  {
		  return mysql_real_escape_string($string);
	  }

	  public function escapeArray($array)
	  {
	    array_walk_recursive($array, create_function('&$v', '$v = mysql_real_escape_string($v);'));
		  return $array;
	  }
	
	  public function to_bool($val)
	  {
	      return !!$val;
	  }
	
	  public function to_date($val)
	  {
	      return date('Y-m-d', $val);
	  }
	
	  public function to_time($val)
	  {
	      return date('H:i:s', $val);
	  }
	
	  public function to_datetime($val)
	  {
	      return date('Y-m-d H:i:s', $val);
	  }
	
	  public function query($qry)
	  {
		  $result = $this->db->query($qry) or die('MySQL Error: '. $this->db->error);
		  $resultObjects = array();

		  while($row = $result->fetch_object()) $resultObjects[] = $row;

		  return $resultObjects;
	  }

	  public function execute($qry)
	  {
		  $exec = $this->db->query($qry) or die('MySQL Error: '. $this->db->error);
		  return $exec;
	  }
	  
	  
      
  }
?>
