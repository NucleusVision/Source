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

    $is_investor_sql = "SELECT `id`, `email`, `first_name`, `last_name`, DATE_FORMAT(dob,'%m/%d/%Y') AS `dob`, `nationality`, `gender`, `residence`, `id_type`, `id_num`, `doc1`, `doc2`, status FROM investors WHERE email = :email";

    $stmt = $conn->prepare($is_investor_sql);
	
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);

    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $investor_data = $stmt->fetch();

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
            $result['kyc_data'] = $investor_data;
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
    

}catch(Exception $e){
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