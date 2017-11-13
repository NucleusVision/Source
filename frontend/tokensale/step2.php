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
$captcha = $_POST['response'];
$verificationCode = clean_data($_POST['verificationCode']);

$secretKey = "6LegUjYUAAAAAG_lvOTZeN_JIXIewR2v_ZkjbYgh";
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
        $user_verify_sql = "SELECT email,token,created_at FROM user_verify WHERE email='".$email."' AND token='".$verificationCode."'";
        $user_verify_result = mysqli_query($conn, $user_verify_sql);

        if (mysqli_num_rows($user_verify_result) > 0) {
            $code = 200;
            $status = "Success";
            $message = "Enter Details";
        } else {
            $code = 400;
            $status = "Failed";
            $message = "Invalid Verification Code";
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