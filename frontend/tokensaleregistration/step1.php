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

$secretKey = "6LegUjYUAAAAAG_lvOTZeN_JIXIewR2v_ZkjbYgh";
$ip = $_SERVER['REMOTE_ADDR'];
$response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
$response = json_decode($response, true);
if($response["success"] === true)
{    
    $investor_sql = 'SELECT email FROM investors WHERE email = :email';
	
	$stmt = $conn->prepare($investor_sql);
	
	$stmt->bindValue(':email', $email, PDO::PARAM_STR);
	
	$stmt->execute();
	
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	$is_investor_found = $stmt->fetch();
	
    if ($is_investor_found !== false) {
        $code = 400;
        $status = "Failed";
        $message = "Email already registered.";
    } else {
        $token = "";   
		
        $user_verify_sql = "SELECT email,activation_code,email_activated,created_at FROM user_verify WHERE email = :email";
	
		$stmt = $conn->prepare($user_verify_sql);
		
		$stmt->bindValue(':email', $email, PDO::PARAM_STR);
		
		$stmt->execute();
		
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		$is_user_found = $stmt->fetch();

        if ($is_user_found !== false) {
            if( $is_user_found['email_activated'] == 1){
                $code = 400;
                $status = "Failed";
                $message = "Your email has already been verified.Please visit http://tokensale.enterstargate.com to complete KYC Details.";
            }else{
                $user_created_at = $is_user_found['created_at'];
                $created_at = date("Y-m-d H:i:s");

				$token = sha1(uniqid().mt_rand().time());
				$update_user_verify = "UPDATE user_verify SET activation_code = :token , created_at = :created_at WHERE email = :email";

				$stmt = $conn->prepare($update_user_verify);
				
				$stmt->bindValue(':token', $token, PDO::PARAM_STR);
				$stmt->bindValue(':created_at', $created_at, PDO::PARAM_STR);
				$stmt->bindValue(':email', $email, PDO::PARAM_STR);
				
				if(!$stmt->execute()){
					die('error');
				}	
            }
        } else {
            $token = sha1(uniqid().mt_rand().time());
			$created_at = date("Y-m-d H:i:s");
            $insert_user_verify = "insert into user_verify(email, activation_code, created_at) values(:email, :token, :created_at);";
            
			$stmt = $conn->prepare($insert_user_verify);
				
			$stmt->bindValue(':token', $token, PDO::PARAM_STR);
			$stmt->bindValue(':created_at', $created_at, PDO::PARAM_STR);
			$stmt->bindValue(':email', $email, PDO::PARAM_STR);
			
			if(!$stmt->execute()){
				die('error');
			}
        }
        
		if($code != 400 && $code == ""){
		
        $isMailSent = true;

        try{
            $code = $token;
            $fields_string = "";

            //$url = 'http://tokenadmin.enterstargate.com/investors/verify/email';
            $url = 'http://redemptiondata.bellboi.com/ajaxVerifyMail_test.php';

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
                    throw new Exception(); 
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
        }catch(Exception $e){
                $isMailSent = false;
        } 
		
        if($isMailSent){
            $code = 200;
            $status = "Success";
            $message = "Activation Link email sent!";
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
    //$message = $e->getMessage();
    $message = "The server is currently busy. Please try again later.";
}

$result = array(
    'status' => $status,
    'message' => $message
);

http_response_code($code);
echo json_encode($result);
?>