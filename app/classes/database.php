<?php

/**
 *
 * This class connects the CMS to database
 *
 * This class also does CRUD functions
 *
 */

namespace App\classes;

class Database
{
	protected $connection;

	function __construct()
	{
		$host_name = 'localhost';
		$user_name = 'root';
		$password = '';
		$db_name = 'database_for_demonstration';

		$this->connection = mysqli_connect($host_name, $user_name, $password, $db_name);

		if(!$this->connection){
			die('Connection failed'.mysqli_error($this->connection));
		}	
	}

	protected function run_query_to_save_or_update_data($sql)
	{
		if(mysqli_query($this->connection, $sql)){
			
		}
		else{
			die('Query problem'.mysqli_error($this->connection));
		}
	}

	protected function run_query_for_data($sql)
	{
		if(mysqli_query($this->connection, $sql)){
			$query_result = mysqli_query($this->connection, $sql);
			return $query_result;
		}
		else{
			die('Query problem'.mysqli_error($this->connection));
		}		
	}

}