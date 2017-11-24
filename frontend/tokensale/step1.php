<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function clean_data($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

try{
		
header("Content-Type: application/json");
require 'config.php';
$result = array();
$code = "";
$status = "";
$message = "";

$email = clean_data($_POST['email']);
$captcha = $_POST['response'];

//$secretKey = "6LegUjYUAAAAAG_lvOTZeN_JIXIewR2v_ZkjbYgh";//original
$secretKey = "6LeTxTcUAAAAAGwy89ptRBrmGPPNFrOXmSEGeC69";//halcyon.user
$ip = $_SERVER['REMOTE_ADDR'];
$response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
$response = json_decode($response, true);
if($response["success"] === true)
{    
    $investor_sql = "SELECT email FROM investors WHERE email='".$email."'";
    $investor_result = mysqli_query($conn, $investor_sql);

    if (mysqli_num_rows($investor_result) > 0) {
        $code = 400;
        $status = "Failed";
        $message = "Email already registered.";
    } else {
        $token = "";        
        $user_verify_sql = "SELECT email,token,created_at,email_activated FROM user_verify WHERE email='".$email."'";
        $user_verify_result = mysqli_query($conn, $user_verify_sql);

        if (mysqli_num_rows($user_verify_result) > 0) {
            $user_verify_row = mysqli_fetch_array($user_verify_result, MYSQLI_ASSOC);
			
			if($user_verify_row['email_activated'] == 1){
				$user_created_at = $user_verify_row['created_at'];
				$time1 = date("Y-m-d H:i:s");
				$time2 = $user_created_at;
				$hourdiff = round((strtotime($time1) - strtotime($time2))/3600,1);
				
				//file_put_contents("test.txt", "time1: ".$time1."time2: ".$time2."hour diff".$hourdiff);

				if($hourdiff > 1 || empty($user_verify_row['token'])){
					$token = bin2hex(openssl_random_pseudo_bytes(16));
					$update_user_verify = "UPDATE user_verify SET token = '".$token."',created_at='".$time1."' WHERE email = '".$email."'";		
					mysqli_query($conn, $update_user_verify) or die(mysqli_error($conn));
				}else{
					$token = $user_verify_row['token'];
				}
				
			}else{
				$code = 400;
				$status = "Failed";
				$message = "Your email is not verified.Please check your email for activation link.";
			}
			
        } else {
            //$token = bin2hex(openssl_random_pseudo_bytes(16));
            //$insert_user_verify = "insert into user_verify (email, token) values('".$email."', '".$token."');";
            //mysqli_query($conn, $insert_user_verify);
			$code = 400;
			$status = "Failed";
			$message = "Your email need to be verified.Please visit http://tokensaleregistration.enterstargate.com to complete verification process.";
        }
        
		if($code != 400 || $code==""){
		
		$isMailSent = true;
		
		try{
			$code = $token;
			$fields_string = "";
			
			//$url = 'http://tokenadmin.enterstargate.com/investors/verify/email';
			$url = 'http://redemptiondata.bellboi.com/ajaxMail1.php';
			
			$fields = array(
				'email' => urlencode($email),
				'code' => urlencode($code) 
			);

			//url-ify the data for the POST
			foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
			rtrim($fields_string, '&');

			//open connection
			$ch = curl_init();

			//set the url, number of POST vars, POST data
			curl_setopt($ch,CURLOPT_URL, $url);
			curl_setopt($ch,CURLOPT_POST, count($fields));
			curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

			//execute post
			$curlResp = curl_exec($ch);

			//close connection
			curl_close($ch);

			if ($curlResp === FALSE) {
				throw new \Exception(); 
			}else{
				/*
				$response = json_decode($curlResp);

				if($response->message == "success"){
					
				}else{
					$isMailSent = false;
				}
				*/
				if(!($curlResp == "success")){
					$isMailSent = false;
				}
			}
		}catch(\Exception $e){
			$isMailSent = false;
		} 
		

        if($isMailSent){
            $code = 200;
            $status = "Success";
            $message = "Verification Code email sent!";
        }else{
            $code = 400;
            $status = "Failed";
            $message = "Error while sending email. Please try again.";
        }
		
		}
		

    }    
}
else
{
    $code = 400;
    $status = "Failed";
    $message = "Failed to verify ReCaptcha";
}

}catch(\Exception $e){
    $code = 400;
    $status = "Failed";
    $message = $e->getMessage();
    //$message = "The server is currently busy. Please try again later.";
}

$result = array(
    'status' => $status,
    'message' => $message
);

http_response_code($code);
echo json_encode($result);
?>