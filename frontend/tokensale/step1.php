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
$ip = $_SERVER['REMOTE_ADDR'];

if(g_captcha_verify($ip, $captcha))
{     
    $investor_data = is_investor_exist($email, $conn);
    if ($investor_data !== false) {
        $code = 400;
        $status = "Failed";
        $message = "Email already registered.";
    } else {
        $token = "";        
        $user_data = is_user_exist($email, $conn);
        
        if ($user_data !== false) {
			
            if($user_data['email_activated'] == 1){
                $token = bin2hex(openssl_random_pseudo_bytes(16));
                $created_at = date("Y-m-d H:i:s");

                $update_user_verify = "UPDATE user_verify SET token = :token , created_at = :created_at WHERE email = :email";

                $stmt = $conn->prepare($update_user_verify);

                $stmt->bindValue(':token', $token, PDO::PARAM_STR);
                $stmt->bindValue(':created_at', $created_at, PDO::PARAM_STR);
                $stmt->bindValue(':email', $email, PDO::PARAM_STR);

                if(!$stmt->execute()){
                    die('error');
                }	
                

            }else{
                    $code = 400;
                    $status = "Failed";
                    $message = "Your email is not verified.Please check your email for activation link.";
            }
			
        } else {
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

}catch(Exception $e){
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