<?php
// Start the session
session_start();
function clean_data($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
try{
$Err = "";
require 'config.php';
$message = "";

if(isset($_GET['email']) && !empty($_GET['email']) && isset($_GET['code']) && !empty($_GET['code'])){

$email = clean_data($_REQUEST['email']);
$code = clean_data($_REQUEST['code']);
   
$investor_sql = "SELECT email, email_activated, activation_code, kyc_completed FROM user_verify WHERE email='".$email."' and activation_code='".$code."'";

$investor_result = mysqli_query($conn, $investor_sql);
    if (mysqli_num_rows($investor_result) > 0) {
			$user_row = mysqli_fetch_array($investor_result, MYSQLI_ASSOC);
			
			if($user_row['email_activated'] != 1){
				
			if($user_row['kyc_completed'] != 1){	
				
            $update_user_verify = "UPDATE user_verify SET email_activated=1 WHERE email = '".$email."' AND activation_code = '".$code."'";
            mysqli_query($conn, $update_user_verify) or die(mysqli_error($conn));
            
            $message = "Your email has been verified successfully.";
            
            try{

                $fields_string = "";

                //$url = 'http://tokenadmin.enterstargate.com/investors/verify/email';
                $url = 'http://redemptiondata.bellboi.com/ajaxActivationMail.php';

                $fields = array(
                        'email' => urlencode($email)
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
                        if(!($curlResp == "success")){
                                $isMailSent = false;
                        }
                }
        }catch(\Exception $e){
                $isMailSent = false;
        }
		
		}else{
			$message = "Invalid url.";
		}
		
	}else{
		$message = "Your have already verified your email.";
	}
		
    } else {
            $message = "Invalid url.";
    }    
}else{
    
}
        
        
}catch(\Exception $e){
    $message = "Invalid url (or) Email has already been verified.";
}

$_SESSION["verify-status"] = $message;
//echo $_SESSION["verify-status"];exit;
header('Location: verify-status.php');

?>
