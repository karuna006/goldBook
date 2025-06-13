<?php 
	ob_start();
	include_once '../../model/db.php';
	include_once 'common_function.php';
	session_start();
	// if(isset($_GET['status'])) {
	// 	$id = $_SESSION['pinto_data']['id'];
    //     $aid = $_SESSION['pinto_data']['aid'];
    //     $fid = $_SESSION['pinto_data']['fid'];
	// 	unset($_SESSION['pinto_data']);
	// 	$raw_data['login_status'] = '0';
	// 	$condition = "(`id` = '".$id."')";
	// 	$result = update($raw_data,'user',$condition,db_connect());		
	// }
	unset($_SESSION['user_details']);
	header('location: ../');
?>