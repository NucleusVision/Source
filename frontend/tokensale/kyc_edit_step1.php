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
    $is_investor_sql = "SELECT email FROM investors WHERE email='".$email."'";
    $is_investor_result = mysqli_query($conn, $is_investor_sql);
    
    if (mysqli_num_rows($is_investor_result) > 0) {
        
    $investor_kyc_row = mysqli_fetch_array($is_investor_result, MYSQLI_ASSOC);   
    
    if($investor_kyc_row['status'] == 'Approved'){
        $code = 400;
        $status = "Failed";
        $message = "Your application is already approved.";
    } else {
        $token = "";        
        $user_verify_sql = "SELECT email,kyc_edit_token,created_at FROM user_verify WHERE email='".$email."'";
        $user_verify_result = mysqli_query($conn, $user_verify_sql);

        if (mysqli_num_rows($user_verify_result) > 0) {
            $user_verify_row = mysqli_fetch_array($user_verify_result, MYSQLI_ASSOC);
            
            if(empty($user_verify_row['kyc_edit_token'])){

                $code = 400;
                $status = "Failed";
                $message = "Email Not Found.";
            }
        } else {
            $code = 400;
            $status = "Failed";
            $message = "Email Not Found.";
        }

        if($code != 400 || $code==""){
            $code = 200;
            $status = "Success";
            $message = "Success";
        }
		
    }

    } else {
        $code = 400;
        $status = "Failed";
        $message = "Email Not Found";
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