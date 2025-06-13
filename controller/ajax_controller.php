<?php
	session_start();
	date_default_timezone_set('Asia/Kolkata');
	include_once '../model/db.php';
	include_once 'common_function.php';		
	
	if(isset($_POST) && !empty($_POST)) {
		if($_POST['from'] == 'get_data') {
			$raw_data = get_data($_POST['table'],$_POST['condition'])[0];
			echo json_encode($raw_data, JSON_FORCE_OBJECT);			
		}

		if($_POST['from'] == 'encrypt_decrypt') {
			print_r(encrypt_decrypt('encrypt',$_POST['text']));
		}

		if($_POST['from'] == 'implode') {
			print_r(implode($_POST['glue'],$_POST['text']));
		}

		if($_POST['from'] == 'check_login') {					
			if(!isset($_SESSION['login_data'])) {
				$condition = "(`username` = '".$_POST['username']."') && (`password` = '".encrypt_decrypt('encrypt',$_POST['password'])."')";
				$raw_data = get_data('users',$condition);
				if($raw_data != "empty") {
					$_SESSION['user_details'] = $raw_data[0];
					echo "request_success";
				} else {
					echo "request_not_found";
				}
			} else {
				echo "request_exits";
			}					    
		}					
	}	
?>