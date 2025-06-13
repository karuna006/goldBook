<?php
	date_default_timezone_set('Asia/Kolkata');
	function encrypt_decrypt($action, $string) 
	{
		$output = false;
		$encrypt_method = "AES-256-CBC";
		$secret_key = '&DCwgt+s8^4YxGHm';
		$secret_iv = 'm8waJ4K8-P+nuZ!q';
		$key = hash('sha256', $secret_key);
		$iv = substr(hash('sha256', $secret_iv), 0, 16);
		if ( $action == 'encrypt' ) 
		{
			$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
			$output = base64_encode($output);
		} 
		else if( $action == 'decrypt' )
		{
			$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
		}
		return $output;
	}	

	function getcode()
	{
	   $string = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	   $string_shuffled = str_shuffle($string);
	   $code = substr($string_shuffled, 1, 10);
	   return $code;
	}

	function get_data($table,$condition)
	{
		if(!empty($condition))
		{
			$raw_data = select('*',$table,$condition,db_connect());
		}
		else
		{
			$raw_data = select('*',$table,'',db_connect());
		}
		return $raw_data;
	}	
	
	function array_flatten($array)
	{ 
		if (!is_array($array))
		{ 
			return FALSE; 
		} 
		$result = array(); 
		foreach ($array as $key => $value)
		{ 
			if (is_array($value))
			{ 
				$result = array_merge($result, array_flatten($value)); 
			} 
			else
			{ 
				$result[$key] = $value; 
			} 
		} 
		return $result; 
	}		
	
	function array_values_recursive($array) {
	  $flat = array();
	  foreach($array as $value) {
	    if (is_array($value)) {
	        $flat = array_merge($flat, array_values_recursive($value));
	    }
	    else {
	        $flat[] = $value;
	    }
	  }
	  return $flat;
	}

	function print_function($array,$text)
	{
		$data = 'no';
		foreach($array as $key => $value)
		{
			if (stripos($value, $text) !== FALSE)
			{
            	$data = 'ok';				
			}			
		}
		return $data;
	}	
	function filter_array($array,$text)
	{
		if($array != 'empty')
		{		
			$filter_data = [];
			foreach($array as $key => $value)
			{
				$full_array = array_values_recursive($value);
				if(print_function($full_array,$text) == 'ok')
				{
					$filter_data[] = $value;
				}
			}
		}
		else
		{
			$filter_data = [];	
		}
		return $filter_data;
	}

	function partition($list, $p) {
	    $listlen = count($list);
	    $partlen = floor($listlen / $p);
	    $partrem = $listlen % $p;
	    $partition = array();
	    $mark = 0;
	    for($px = 0; $px < $p; $px ++) {
	        $incr = ($px < $partrem) ? $partlen + 1 : $partlen;
	        $partition[$px] = array_slice($list, $mark, $incr);
	        $mark += $incr;
	    }
	    return $partition;
	}

	function get_main_parent($parent_id)
	{
		$condition = "(`id` = '".$parent_id."') AND (`status` = '1')";
		$parent_category = get_data('product_category',$condition)[0];
		if($parent_category != 'e')
		{	
			if($parent_category['type'] == '1')
			{				
				return $parent_category['id'];		
			}
			else
			{
				return get_main_parent($parent_category['parent_id']);
			}
		}		
	}

	function get_all_parent_data($child)
	{
		$result = array();
		$condition = "(`id` = '".$child."') AND (`status` = '1')";
		$main_category = get_data('product_category',$condition)[0];
		if($main_category != 'e')
		{
			$result[] = $main_category;
			if($main_category['type'] == '2')
			{			
				$result = array_merge($result,get_all_parent_data($main_category['parent_id']));			
			}
		}
		return $result;
	}

	function get_all_child_id($parent)
	{
		$result = array();
		$condition = "(`parent_id` = '".$parent."') AND (`status` = '1')";
		$sub_category = get_data('product_category',$condition);	
		if($sub_category != 'empty')
		{
			foreach($sub_category as $key => $value)
			{
				$result[] = $value['id'];
				$result = array_merge($result,get_all_child_id($value['id']));
			}
		}
		return $result;
	}

	function print_all_sub_category($parent,$type,$name)
	{		
		$condition = "(`parent_id` = '".$parent."') AND (`type` = '".$type."') AND (`status` = '1')";
		$sub_category = get_data('product_category',$condition);
		if($sub_category != 'empty')
		{	
			echo "<ul>";
			foreach($sub_category as $key => $value)
			{
				echo "<li data-parentID='".get_main_parent($value['id'])."' data-name='".$name."' data-ai='".$value['id']."' data-type='sub_category' data-id='".$value['id']."' class='id_".$value['id']." c_list expanded'>".$value['category_name'];
				print_all_sub_category($value['id'],'2',$name.' -> '.$value['category_name']);
				echo "</li>";
			}
			echo "</ul>";
		}	
	}

	function get_all_parent_id($child)
	{
		$result = array();
		$condition = "(`id` = '".$child."') AND (`status` = '1')";
		$main_category = get_data('product_category',$condition)[0];
		if($main_category != 'e')
		{			
			$result[] = $main_category['id'];
			$result = array_merge($result,get_all_parent_id($main_category['parent_id']));			
		}
		return $result;
	}

	function generate_combinations(array $data, array &$all = array(), array $group = array(), $value = null, $i = 0)
	{
	    $keys = array_keys($data);
	    if (isset($value) === true) {
	        array_push($group, $value);
	    }

	    if ($i >= count($data)) {
	        array_push($all, $group);
	    } else {
	        $currentKey     = $keys[$i];
	        $currentElement = $data[$currentKey];
	        foreach ($currentElement as $val) {
	            generate_combinations($data, $all, $group, $val, $i + 1);
	        }
	    }

	    return $all;
	}

?>