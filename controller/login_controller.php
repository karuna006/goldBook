<?php 
	session_start();
	include_once '../../model/db.php';
	include_once 'common_function.php';
	ob_start();
	if(isset($_POST) && !empty($_POST) && !isset($_GET['action']))
	{
		$_POST['password'] = encrypt_decrypt('encrypt',$_POST['password']);
		$condition  = "((`username` = '".$_POST['username']."') AND (`password` = '".$_POST['password']."')) AND (`status` = '1')";
		$user_data = get_data('login_data',$condition);			
		if($user_data != 'empty')
		{
			$_SESSION['niramart_admin'] = $user_data[0];
			header("location: ../view/index.php");
		}
		else
		{				
			header("location: ../index.php?status=error");
		}			
	}
 ?>