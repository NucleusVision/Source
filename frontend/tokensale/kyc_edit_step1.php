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

    if($investor_data['status'] == 'Approved'){
        $code = 400;
        $status = "Failed";
        $message = "Your application is already approved.";
    } else {
        $user_data = is_user_exist($email, $conn);

        if ($user_data !== false) {

            if(empty($user_data['kyc_edit_token'])){

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