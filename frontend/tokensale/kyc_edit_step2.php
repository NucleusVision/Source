<?php
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
$verificationCode = clean_data($_POST['verificationCode']);

$ip = $_SERVER['REMOTE_ADDR'];
$captcha = $_POST['response'];

if(g_captcha_verify($ip, $captcha))
{    
    $investor_data = is_investor_exist($email, $conn);
    
    if ($investor_data !== false) {
        
    if($investor_data['status'] == 'Approved'){
        $code = 400;
        $status = "Failed";
        $message = "Your application is already approved.";
    } else {       
        
        $user_data = is_user_exist_with_kyc_token($email, $verificationCode, $conn);
        
        if ($user_data !== false) {
            $code = 200;
            $status = "Success";
            $message = "Enter Details";
        } else {
            $code = 400;
            $status = "Failed";
            $message = "Invalid Verification Code";
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