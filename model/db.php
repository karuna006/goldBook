<?php 
	include_once 'curd_operations.php';
	function db_connect(){
		$connection = mysqli_connect("localhost", "root", "", "goldbook");		
		if (!$connection) {
			die("Connection failed: " . mysqli_connect_error());
			exit();
		}
		return $connection;
	}

	function execute_query_return_id($query, $link){
		if(!empty($link)){
			$data['status'] = mysqli_query($link, $query);
			$data['last_id'] = mysqli_insert_id($link);
			return $data;
		}else{
			return mysqli_query(db_connect(), $query);
		}
	}

	function execute_query($query, $link){
		if(!empty($link)){
			return mysqli_query($link, $query);
		}else{
			return mysqli_query(db_connect(), $query);
		}
	}

	function get_array_from_object($result){
		return mysqli_fetch_array($result, MYSQLI_ASSOC);
	}

	function sanitize($input, $con){
		return mysqli_real_escape_string($con, $input);
	}
	?>