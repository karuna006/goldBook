<?php
	include 'src/Instamojo.php';
	/* $returnUrl ='http://www.example.com/handle_redirect.php';
	 $pamenyArr =  pay_ment('hari','9944414358','hariharan856856@gmail.com','100',$returnUrl);
	 if($pamenyArr){
	 	$url =$pamenyArr['longurl'];
	 	header('Location: '.$url);
	 }*/
	
	function pay_ment($name,$phone,$email,$amt,$returnUrl){
		$key="aba4c7461a22f92fff96e6df773573d4";
		$token="bb260624cf645cc778aaa084b68b8280";
		$api = new Instamojo\Instamojo($key, $token);
		try {
   			$response = $api->paymentRequestCreate(array(
					"purpose" => 'ARGUTES',
					"amount" => $amt,
					"send_email" => true,
					"send_sms" => false,
					"email" => $email,
					"buyer_name" => $name,
					"phone" => $phone,
					"redirect_url" =>$returnUrl
			));
			return $response;
			//$url =$response['longurl'];
			//echo $url;
			//header('Location: '.$url);
		}
		catch (Exception $e) {
    		print('Error: ' . $e->getMessage());
		}
	}
?>