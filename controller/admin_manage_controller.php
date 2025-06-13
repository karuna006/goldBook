<?php	
	session_start();
	include_once '../../model/db.php';
	include_once 'common_function.php';
		
	if(isset($_GET['action']))
	{
		if($_GET['action'] == 'add')
		{
            echo "<pre>";
            print_r($_REQUEST);
            echo "</pre>";
			// $raw_data['radius'] = $_POST['radius'];
			// $city = explode(',',$_POST['city']);
			// $raw_data['city'] = $city[0];

			// $condition = "(`city` = '".$raw_data['city']."') AND (`status` = '1')";
	    	// $range_meter = get_data('range_meter',$condition)[0];

	    	// if($raw_data != 'e')
	    	// {
	    	// 	$result = insert('range_meter',$raw_data, db_connect());
	    	// 	if($result)
	    	// 	{
	    	// 		$_SESSION['response'] = 'success';
	    	// 	}
	    	// 	else
	    	// 	{
	    	// 		$_SESSION['response'] = 'insert_error';    				
	    	// 	}
	    	// }
	    	// else
	    	// {
	    	// 	$_SESSION['response'] = 'city_exist';    				
	    	// }	    	
		}
		elseif($_GET['action'] == 'update')
		{
			// $update_data['radius'] = $_POST['radius'];
			// $condition = "(`id` = '".($_GET['id'])."')";				
			// $result = update($update_data,'range_meter',$condition,db_connect());

			// if($result)
			// {
			// 	$_SESSION['response'] = 'updated';
			// }
			// else
			// {
			// 	$_SESSION['response'] = 'updated_error';	
			// }
		}
	}
	// header('location: ../view/range_meter.php');
?>