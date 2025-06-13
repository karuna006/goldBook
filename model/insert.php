<?php 

	function insert($table_name, $column_names_and_values, $conn){
		$table_name = sanitize($table_name, $conn);
		$sql = get_insert_query($table_name, $column_names_and_values, $conn);
	
		// print_r($sql);echo "<br>";
		return execute_query($sql, $conn);
	}

	function insert_return_id($table_name, $column_names_and_values, $conn)
	{
		$table_name = sanitize($table_name, $conn);
		$sql = get_insert_query($table_name, $column_names_and_values, $conn);
		//return $sql;
			// print_r($sql);echo "<br>";
		return execute_query_return_id($sql, $conn);	
	}

	function get_insert_query($table_name, $column_names_and_values, $conn){
		$sql = "INSERT INTO ";
		if(!empty($table_name)){
			$sql = $sql.$table_name;
		}
		$i = 1;
		foreach ($column_names_and_values as $column_name => $value) {
			$column_name = sanitize($column_name, $conn);
			$value = sanitize($value, $conn);
			if($i == 1){
				$total_column_name = '`'.$column_name.'`';
				$value = mysqli_real_escape_string($conn,$value);
				$total_column_value = '"'.stripslashes(str_replace('\r\n',PHP_EOL,$value)).'"';
				++$i;
			} else{
				$total_column_name = $total_column_name.', `'.$column_name.'`';
				$value = mysqli_real_escape_string($conn,$value);
				$total_column_value = $total_column_value.', "'.stripslashes(str_replace('\r\n',PHP_EOL,$value)).'"';
			}
		}
		return $sql." ( ".$total_column_name." ) VALUES ( ".$total_column_value." )";
	}