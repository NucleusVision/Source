<?php

function clean_data($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
define('UPLOAD_DIR', 'uploads/');
function saveImage($base64img){
    list($type, $data) = explode(';', $base64img);
    list(, $data)      = explode(',', $data);
    $extension = ".jpg";
    if($type == "data:image/png"){
        $extension = '.png';
    }
    //file_put_contents("test.txt", $data);
    $data = base64_decode($data);
    
    $filename =  md5(uniqid()) . "-" . date('Y-m-d-h-i-s') .  $extension;
    
    $fullPath = UPLOAD_DIR . $filename;
    
    $is_uploaded = file_put_contents($fullPath, $data);
    if($is_uploaded){
        return $filename;
    }
    return false;
}

function makeThumbnails($img)
{
    $arr_image_details = getimagesize(UPLOAD_DIR . $img); // pass id to thumb name
    $original_width = $arr_image_details[0];
    $original_height = $arr_image_details[1];

    if ($arr_image_details[2] == IMAGETYPE_GIF) {
        $imgt = "ImageGIF";
        $imgcreatefrom = "ImageCreateFromGIF";
    }
    if ($arr_image_details[2] == IMAGETYPE_JPEG) {
        $imgt = "ImageJPEG";
        $imgcreatefrom = "ImageCreateFromJPEG";
    }
    if ($arr_image_details[2] == IMAGETYPE_PNG) {
        $imgt = "ImagePNG";
        $imgcreatefrom = "ImageCreateFromPNG";
    }

    $newwidthLarge=160;

    //Set new height for image
    // $newheightLarge=160;

    // or Calculate and scale it proportanly
    $newheightLarge=round(($original_height*$newwidthLarge)/$original_height);
     // ----------------------------------------------------
       
    if ($imgt) {
        $old_image = $imgcreatefrom(UPLOAD_DIR . $img);
        
        //Creating the thumbnail from true color
        $tmp=imagecreatetruecolor($newwidthLarge,$newheightLarge);
        //Enable image interlace property
        imageinterlace($tmp, 1);
        //Create a image with given dimension
        imagecopyresampled($tmp,$old_image,0,0,0,0,$newwidthLarge,$newheightLarge, $original_width, $original_height);    
        
        $krowAvatar=time().$img;
		$img_thumbLarge = 'uploads/thumbs/' . $krowAvatar;
        
        //Put the image data to newly created Image
        $createImageSave=$imgt($tmp,$img_thumbLarge);
        
    }else{
        return false;
    }
    return $krowAvatar;
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
    
    if($investor_kyc_row['status'] == 'Approved'){
        $code = 400;
        $status = "Failed";
        $message = "Your application is already approved.";
    }  else {
        $token = "";        
        $user_verify_sql = "SELECT email,kyc_edit_token,created_at FROM user_verify WHERE email='".$email."' AND kyc_edit_token='".$verificationCode."'";
        $user_verify_result = mysqli_query($conn, $user_verify_sql);

        if (mysqli_num_rows($user_verify_result) > 0) {
            
            $eth = clean_data($_POST['eth']);
            $fName = clean_data($_POST['fName']);
            $lName = clean_data($_POST['lName']);
            $dob = date("Y-m-d", strtotime(clean_data($_POST['dob'])));
            $nationality = clean_data($_POST['nationality']);
            $gender = clean_data($_POST['gender']);
            $residence = clean_data($_POST['residence']);
            $id_type = clean_data($_POST['id_type']);
            $id_num = clean_data($_POST['id_num']);
            $is_doc_change = clean_data($_POST['is_doc_change']);
            $is_selfie_change = clean_data($_POST['is_selfie_change']);
            
            $document = $thumb1 = $selfie = $thumb2 = true;
            
            if($is_doc_change == "yes"){
                $document = saveImage($_POST['encodedDocData']['document']);
                $thumb1 = makeThumbnails($document);
            }
            
            if($is_selfie_change == "yes"){
                $selfie = saveImage($_POST['encodedDocData']['selfie']);
                $thumb2 = makeThumbnails($selfie);
            }
            
            if($document && $selfie && $thumb1 && $thumb2){
               
            $update_investors = "";    
 
            if($is_doc_change == "no" && $is_selfie_change == "no"){
                $update_investors = "UPDATE investors SET `id`='".$eth."',`first_name`='".$fName."',`last_name`='".$lName."',`dob`='".$dob."',`nationality`='".$nationality."',`gender`='".$gender."',`residence`='".$residence."',`id_type`='".$id_type."',`id_num`='".$id_num."',`status`='Pending' WHERE email = '".$email."'";
            }else{
                if($is_doc_change == "yes" && $is_selfie_change == "no"){
                    $update_investors = "UPDATE investors SET `id`='".$eth."',`first_name`='".$fName."',`last_name`='".$lName."',`dob`='".$dob."',`nationality`='".$nationality."',`gender`='".$gender."',`residence`='".$residence."',`id_type`='".$id_type."',`id_num`='".$id_num."',`doc1`='".$document."',`thumb1`='".$thumb1."',`status`='Pending' WHERE email = '".$email."'";
                    
                }elseif($is_doc_change == "no" && $is_selfie_change == "yes"){
                    $update_investors = "UPDATE investors SET `id`='".$eth."',`first_name`='".$fName."',`last_name`='".$lName."',`dob`='".$dob."',`nationality`='".$nationality."',`gender`='".$gender."',`residence`='".$residence."',`id_type`='".$id_type."',`id_num`='".$id_num."',`doc2`='".$selfie."',`thumb2`='".$thumb2."',`status`='Pending' WHERE email = '".$email."'";
                }elseif($is_doc_change == "yes" && $is_selfie_change == "yes"){
                    $update_investors = "UPDATE investors SET `id`='".$eth."',`first_name`='".$fName."',`last_name`='".$lName."',`dob`='".$dob."',`nationality`='".$nationality."',`gender`='".$gender."',`residence`='".$residence."',`id_type`='".$id_type."',`id_num`='".$id_num."',`doc1`='".$document."',`doc2`='".$selfie."',`thumb1`='".$thumb1."',`thumb2`='".$thumb2."',`status`='Pending' WHERE email = '".$email."'";
                }
                
            }

				if(mysqli_query($conn, $update_investors)){
					
				//$update_user_verify = "UPDATE user_verify SET kyc_completed = 1 WHERE email = '".$email."'";		
				//mysqli_query($conn, $update_user_verify) or die(mysqli_error($conn));	
            
				$code = 200;
				$status = "Success";
				$message = "Request submitted successfully.";
				
                                /*
				try{

				$fields_string = "";
				
				//$url = 'http://tokenadmin.enterstargate.com/investors/kyc/email';
				$url = 'http://redemptiondata.bellboi.com/ajaxMail2.php';
				
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

				//echo $curlResp;
				
				if ($curlResp === FALSE) {
					throw new \Exception(); 
				}else{

				}
				}catch(\Exception $e){
					
				}
                                 */ 

			 }else{
				$code = 400;
				$status = "Failed";
				$message = "The internal server error. Please try again later.";
			 }

            }else{
                $code = 400;
                $status = "failed";
                $message = "Error uploading documents.Please try again.";
            }

        } else {
            $code = 400;
            $status = "Failed";
            $message = "Invalid Verification Code";
        }
          
    } 
    
    }else {
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
    //$message = $e->getMessage();
    $message = "The server is currently busy. Please try again later.";
}

$result = array(
    $status = $status,
    $message = $message
);

http_response_code($code);
echo json_encode($result);

?>