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

    $is_investor_sql = "SELECT `id`, `email`, `first_name`, `last_name`, `dob`, `nationality`, `gender`, `residence`, `id_type`, `id_num`, `doc1`, `doc2` FROM investors WHERE email='".$email."'";
    
    $is_investor_result = mysqli_query($conn, $is_investor_sql);
    
    if (mysqli_num_rows($is_investor_result) > 0) {
        
    $investor_kyc_row = mysqli_fetch_array($is_investor_result, MYSQLI_ASSOC);

    if($investor_kyc_row['status'] == 'Approved'){
        $code = 400;
        $status = "Failed";
        $message = "Your application is already approved.";
    } else {       
        $user_verify_sql = "SELECT email,kyc_edit_token,created_at FROM user_verify WHERE email='".$email."' AND kyc_edit_token='".$verificationCode."'";
        $user_verify_result = mysqli_query($conn, $user_verify_sql);

        if (mysqli_num_rows($user_verify_result) > 0) {
            $code = 200;
            $status = "Success";
            $message = "Enter Details";
            $result['kyc_data'] = $investor_kyc_row;
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
    

}catch(\Exception $e){
    $code = 400;
    $status = "Failed";
    //$message = $e->getMessage();
    $message = "The server is currently busy. Please try again later.";
}


$result['status'] = $status;
$result['message'] = $message;


http_response_code($code);
echo json_encode($result);
?>