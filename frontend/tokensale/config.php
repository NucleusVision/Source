<?php
error_reporting(0);
date_default_timezone_set('Asia/Kolkata');
$servername = "localhost";
//$username = "nucleusvision";
//$password = "nucleus@vision";
$username = "root";
$password = "";
$dbname = "nucleusvision";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully"; 
	
}
catch(PDOException $e)
{
	die("Connection failed: " . $e->getMessage());
}
function is_investor_exist($i_email, $conn){
	
	$investor_sql = 'SELECT email FROM investors WHERE email = :email';
	
	$stmt = $conn->prepare($investor_sql);
	
	$stmt->bindValue(':email', $i_email, PDO::PARAM_STR);
	
	$stmt->execute();
	
	$stmt->setFetchMode(PDO::FETCH_ASSOC);

	$data_returned = $stmt->fetch();
	
        if ($data_returned !== false) {
		  return $data_returned;
	} else {
		return false;
	}
}

function is_user_exist($u_email, $conn){

	$user_verify_sql = "SELECT email, token, kyc_edit_token, created_at, email_activated FROM user_verify WHERE email = :email";
	
	$stmt = $conn->prepare($user_verify_sql);
	
	$stmt->bindValue(':email', $u_email, PDO::PARAM_STR);
	
	$stmt->execute();
	
	$stmt->setFetchMode(PDO::FETCH_ASSOC);

	$data_returned = $stmt->fetch();
	
        if ($data_returned !== false) {
		  return $data_returned;
	} else {
		return false;
	}
}


function is_user_exist_with_token($u_email, $u_token, $conn){
	
	$user_verify_sql = "SELECT email, token, kyc_edit_token, created_at FROM user_verify WHERE email = :email AND token = :token";
	
	$stmt = $conn->prepare($user_verify_sql);
	
	$stmt->bindValue(':email', $u_email, PDO::PARAM_STR);
	
	$stmt->bindValue(':token', $u_token, PDO::PARAM_STR);
	
	$stmt->execute();
	
	$stmt->setFetchMode(PDO::FETCH_ASSOC);

	$data_returned = $stmt->fetch();
	
        if ($data_returned !== false) {
		  return $data_returned;
	} else {
		return false;
	}
}

function is_user_exist_with_kyc_token($u_email, $u_token, $conn){
	
	$user_verify_sql = "SELECT email, token, kyc_edit_token, created_at FROM user_verify WHERE email = :email AND kyc_edit_token = :token";
	
	$stmt = $conn->prepare($user_verify_sql);
	
	$stmt->bindValue(':email', $u_email, PDO::PARAM_STR);
	
	$stmt->bindValue(':token', $u_token, PDO::PARAM_STR);
	
	$stmt->execute();
	
	$stmt->setFetchMode(PDO::FETCH_ASSOC);

	$data_returned = $stmt->fetch();
	
        if ($data_returned !== false) {
            return $data_returned;
	} else {
            return false;
	}
}
function g_captcha_verify($ip, $captcha){
    $secretKey = "6LegUjYUAAAAAG_lvOTZeN_JIXIewR2v_ZkjbYgh";
    $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
    $response = json_decode($response, true);
    if($response["success"] === true)
    { 
        return true;
    }else{
        return false;
    }
}
?>