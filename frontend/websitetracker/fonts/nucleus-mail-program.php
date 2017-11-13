<?php
date_default_timezone_set('Asia/Kolkata');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$email = $_POST["email"];

$amount = "";

if(isset($_POST["amount"])){
	$amount = $_POST["amount"];
}

//$to = "info@nucleus.vision";

//$to = "info@bellboi.com";


$subject = "Sale Notification Request";

$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
    <head lang="en">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            <meta name="viewport" content="width=device-width, target-densitydpi=device-dpi, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes" />
            <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
            <title>NUCLEUS</title>
            <meta name="description" content="NUCLEUS">
                <style type="text/css">
                    body {
                        width: 100%;
                        height: 100%;
                        margin: 0;
                        padding: 0;
                        background-color: #e7e7e7;
                        font-family:"Helvetica Neue", Helvetica, Arial, sans-serif;
                        mso-line-height-rule: exactly;
                        -webkit-font-smoothing: antialiased;
                        -ms-text-size-adjust: none !important;
                    }
                    table { border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0; mso-table-rspace: 0; }
                    table td { border-collapse: collapse; mso-table-lspace: 0; mso-table-rspace: 0; }
                    img { border: 0; -ms-interpolation-mode: bicubic; }
                    .heading a { color: #555555; text-decoration: none; }
                    .heading {
                        font-family:"Helvetica Neue", Helvetica, Arial, sans-serif;
                        font-size: 26px;
                        color: #555555;
                        font-weight: 700;
                        line-height: 26px;
                        mso-line-height-rule: exactly;
                        text-align: center;
                        vertical-align: top;
                    }
                    .title a { color: #555555; text-decoration: none; }
                    .title {
                        font-family:"Helvetica Neue", Helvetica, Arial, sans-serif;
                        font-size: 20px;
                        color: #555555;
                        font-weight: 700;
                        line-height: 24px;
                        mso-line-height-rule: exactly;
                        text-align: left;
                        vertical-align: top;
                    }
                    .body-text {
                        color: #525252;
                        font-weight: 400;
                    }
                    .body-text a { color: #20a2dc; font-weight: 700; }
                    .body-text a:hover {
                        color: #167ba8;
                        font-weight: 700;
                        -webkit-transition: all 0.2s ease-in-out;
                        -moz-transition: all 0.2s ease-in-out;
                        -o-transition: all 0.2s ease-in-out;
                        transition: all 0.2s ease-in-out;
                    }
                    .body-text,
                    .body-text a {
                        font-family:"Helvetica Neue", Helvetica, Arial, sans-serif;
                        font-size: 16px;
                        line-height: 22px;
                        mso-line-height-rule: exactly;
                        vertical-align: top;
                        text-decoration: none;
                    }
                    .footer-text {
                        font-family:"Helvetica Neue", Helvetica, Arial, sans-serif;
                        font-size: 14px !important;
                        color: #999999;
                        font-weight: 700;
                        line-height: 1.3 !important;
                        mso-line-height-rule: exactly;
                        text-align: center;
                        vertical-align: top;
                    }
                    .footer-text a { color: #999999; text-decoration: none; font-size: 14px !important;line-height: 1.3 !important;}
                    .button {
                        display: block;
                        font-family:"Helvetica Neue", Helvetica, Arial, sans-serif;
                        font-weight: 700;
                        line-height: 16px;
                        text-decoration: none;
                        text-align: center;
                        -moz-border-radius: 4px;
                        -webkit-border-radius: 4px;
                        border-radius: 4px;
                        word-break: break-word;
                        word-wrap: break-word;
                        background: #337ab7;
                        border: 1px solid #337ab7;
                        color: #ffffff;
                        -webkit-transition: all 0.1s ease-in-out;
                        -moz-transition: all 0.1s ease-in-out;
                        -o-transition: all 0.1s ease-in-out;
                        transition: all 0.1s ease-in-out;
                    }
                    .button:hover {
                        background: #286090 !important;
                        border: 1px solid #286090 !important;

                    }
                    #synopsis {
                        display: none;
                        font-size: 1px;
                        color: #e7e7e7;
                        line-height: 1px;
                        font-family:"Helvetica Neue", Helvetica, Arial, sans-serif;
                        max-height: 0px;
                        max-width: 0px;
                        opacity: 0;
                        overflow: hidden;
                        mso-hide: all;
                    }
                    ul {
                        padding: 0 65px;
                    }
                    .hero-image {display: block; max-width:500px; width: 100%; Margin: 0 auto;}
                    @media only screen and (max-width: 640px)  {
                        .device-width {
                            width: 100% !important;
                            max-width: 460px;
                            padding:0;
                        }
                        .button {
                            width: 92% !important;
                        }
                        ul {
                            padding: 0 25px;
                        }

                    }
                    @media only screen and (max-width: 479px) {
                        .device-width {
                            width: 100% !important;
                            max-width: 330px;
                            padding: 0;
                        }
                        .button {
                            width: 85% !important;
                        }
                        .button1:hover,
                        .button1:hover a{
                            border: 1px solid #286090 !important;
                        }
                        ul {
                            padding: 0 25px;
                        }
                    }
                </style>
                <!--[if gte mso 9]>
                    <xml>
                        <o:OfficeDocumentSettings>
                            <o:AllowPNG/>
                            <o:PixelsPerInch>96</o:PixelsPerInch>
                        </o:OfficeDocumentSettings>
                    </xml>
                <![endif]-->
                </head>
                <body bgcolor="#e7e7e7" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" style="font-family:"Helvetica Neue", Helvetica, Arial, sans-serif; mso-line-height-rule: exactly; width: 100%; background-color: #e7e7e7; margin: 0; padding: 0; -webkit-font-smoothing: antialiased; -ms-text-size-adjust: none !important;">
                    <center>
                        <!--[if (IE)|mso]>
                            <table width="600" align="center" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td valign="top">
                                        <![endif]-->
                        <!-- WRAPPER START -->
                        <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                            <tr>
                                <td width="100%" valign="top" bgcolor="#e7e7e7">

                                    <!-- START SEPERATOR -->
                                    <table border="0" cellpadding="0" cellspacing="0" align="center" style="width: 582px; margin: 0 auto;" class="device-width">
                                        <tr>
                                            <td align="left" valign="bottom" style="text-align: left; vertical-align: bottom;">
                                                <table border="0" cellspacing="0" cellpadding="0" align="right" style="width: 5px;" class="device-width">
                                                    <tr>
                                                        <td bgcolor="#e7e7e7">&nbsp;</td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- END SEPERATOR -->
                                    <!-- START BOX 1 -->
                                    <table border="0" cellspacing="0" cellpadding="0" align="center" style="width: 580px; margin: 0 auto;" class="device-width">
                                        <tr>
                                            <td align="center" bgcolor="#ffffff">
                                                <table border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#ffffff" style="width: 580px;" class="device-width">
                                                    <tr>
                                                        <td align="center" valign="top" bgcolor="#ffffff" style="padding: 40px 40px 17px 40px;" class="heading">
                                                            <a href="#"><img src="http://nucleus.vision/img/logo-color.png" alt="" /></a>
                                                        </td>
                                                    </tr>
                                                    <!-- START SEPERATOR -->
                                                    <tr style="border-bottom:1px solid #dddddd;">
                                                        <td align="center" bgcolor="#ffffff" style="padding:0 0 0;">
                                                            <table border="0" cellpadding="0" cellspacing="0" align="center" style="width: 582px; margin: 0 auto;" class="device-width">
                                                                <tr>
                                                                    <td align="left" valign="bottom" style="text-align: left; vertical-align: bottom;">
                                                                        <table border="0" cellspacing="0" cellpadding="0" align="right" style="width: 5px;" class="device-width">
                                                                            <tr>
                                                                                <td bgcolor="#ffffff">&nbsp;</td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <!-- END SEPERATOR -->
                                                </table>
                                            </td>
                                        </tr>
                                        
                                    </table>
                                    <!-- END BOX 1 -->
                                    <!-- START BOX 2 -->
                                    <table border="0" cellspacing="0" cellpadding="0" align="center" style="width: 580px; margin: 0 auto;" class="device-width">
                                        <tr>
                                            <td align="center" bgcolor="#ffffff">
                                                <table border="0" cellpadding="0" cellspacing="0" align="left" bgcolor="#ffffff" style="width: 580px;" class="device-width">
                                                    <tr>
                                                        <td align="left" valign="top" bgcolor="#ffffff" style="padding: 25px 25px 25px 25px;" class="heading-hello">
                                                            <font color="#525252">
                                                                Hi admin,
                                                            </font>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <table border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#ffffff" style="width: 580px;" class="device-width">
                                                    <!--[if (IE)|mso]><tr height="5"><td width="15">&nbsp;</td></tr><![endif]-->
                                                    <tr>
                                                        <td align="left" bgcolor="#ffffff" style="padding: 0 25px 30px 25px;" class="body-text">
                                                            <p style="font-family:"Helvetica Neue", Helvetica, Arial, sans-serif;font-size: 16px;line-height: 22px;text-decoration: none;font-weight: 400;">
                                                                <b>SALE NOTIFICATION REQUEST DETAILS</b><br/><br/>
																
																<b>Email</b>: '.$email.'<br/>';
																
																if(isset($_POST["amount"])){
																	$message.='<b>Amount</b>: '.$amount.'<br/>';
																}
																
                                                            $message.='</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center" style="padding: 0 0 15px 0;">
                                                            <!-- Start: Blue button -->
                                                            <center>
                                                                <table width="98%" border="0" cellpadding="0" cellspacing="0">
                                                                    <tr>
                                                                        <td align="center">
                                                                            <!--[if (IE)|mso]>
                                                                                <table align="center" border="0" cellpadding="0" cellspacing="0" width="580">
                                                                                    <tr height="25">
                                                                                        <td>
                                                                                            <![endif]-->
                                                                            <table align="center" border="0" cellpadding="0" cellspacing="0" style="max-width: 440px;" width="100%">
                                                                                <tr>
                                                                                    <td style="text-align: center;">
                                                                                        <div>
                                                                                            <!--[if mso]>
                                                                                                <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="" style="height:50px;v-text-anchor:middle;width: 450px;" arcsize="8%" strokecolor="#337ab7" fillcolor="#337ab7">
                                                                                                <w:anchorlock/>
                                                                                                    <center style="color:#FFFFFF;font-family:"Helvetica Neue", Helvetica, Arial, sans-serif;font-size:16px;font-weight:bold;">
                                                                                                       
                                                                                                    </center>
                                                                                                </v:roundrect>
                                                                                            <![endif]-->
                                                                                            
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                            <!--[if (IE)|mso]>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            <![endif]-->
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </center>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <!-- START SEPERATOR -->
                                        <tr style="border-bottom:1px solid #dddddd;">
                                            <td align="center" bgcolor="#ffffff" style="padding:50px 0 0;">
                                                <table border="0" cellpadding="0" cellspacing="0" align="center" style="width: 582px; margin: 0 auto;" class="device-width">
                                                    <tr>
                                                        <td align="left" valign="bottom" style="text-align: left; vertical-align: bottom;">
                                                            <table border="0" cellspacing="0" cellpadding="0" align="right" style="width: 5px;" class="device-width">
                                                                <tr>
                                                                    <td bgcolor="#ffffff">&nbsp;</td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <!-- END SEPERATOR -->
                                        <tr>
                                            <td align="center" bgcolor="#ffffff" style="padding: 8px 25px 10px 25px;" class="body-text">
                                                <b>NUCLEUS</b> <br>
                                                    <!-- P | 0123456789 <br> -->
                                                    E | <a style="color:#717171; text-decoration:none;" href="mailto:info@nucleus.vision">info@nucleus.vision</a><br>
                                                        W | <a style="color:#717171; text-decoration:none;" href="http://nucleus.vision">www.nucleus.vision</a>
                                                        </td>
                                                        </tr>
                                                        </table>
                                                        <!-- END BOX 1 -->
                                                        <!-- START SEPERATOR -->
                                                        <table border="0" cellpadding="0" cellspacing="0" align="center" style="width: 582px; margin: 0 auto;" class="device-width">
                                                            <tr>
                                                                <td align="left" valign="bottom" style="text-align: left; vertical-align: bottom;">
                                                                    <table border="0" cellspacing="0" cellpadding="0" align="right" style="width: 5px;" class="device-width">
                                                                        <tr>
                                                                            <td bgcolor="#e7e7e7">&nbsp;</td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <!-- END SEPERATOR -->
                                                        </td>
                                                        </tr>
                                                        </table>
                                                        <!-- END MAIN WRAPPER -->
                                                        <div style="display:none; white-space:nowrap; font:16px courier; line-height:0;">
                                                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                                        </div>
                                                        <!--[if (IE)|mso]>
                                                    </td>
                                                </tr>
                                            </table>
                                        <![endif]-->
                                                        </center>
                                                        </body>
                                                        </html>';

														
$user_message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
    <head lang="en">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            <meta name="viewport" content="width=device-width, target-densitydpi=device-dpi, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes" />
            <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
            <title>NUCLEUS</title>
            <meta name="description" content="NUCLEUS">
                <!--[if gte mso 9]>
                    <xml>
                        <o:OfficeDocumentSettings>
                            <o:AllowPNG/>
                            <o:PixelsPerInch>96</o:PixelsPerInch>
                        </o:OfficeDocumentSettings>
                    </xml>
                <![endif]-->
                </head>
                <body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" style="background:url(https://nucleus.vision/img/header_bg.jpg) no-repeat center 25% #051721; padding:30px 0px 30px 0px;"><p style="margin-bottom: 50px;text-align:center;" align="center">
                    <img src="https://nucleus.vision/img/emailer_logo.png"></p><div style="width: 500px; margin:0px auto 0px auto; padding: 20px 35px; background: #FFF; border-radius: 15px;"><h1 style="font-family: Titillium Web, sans-serif; font-size: 36px; font-weight: bold; text-align: center;">Congrats!</h1><p style="font-family: Titillium Web, sans-serif; font-size: 21px; text-align: left; color: #ffaa00;">You have successfully signed up for the Nucleus ICO.</p><p style="font-family: Titillium Web, sans-serif; font-size: 21px; text-align: left; margin-top: 30px;">We will keep you informed about important dates and details for participating in the ICO.</p><p align="center"><a style="font-family: Titillium Web, sans-serif; font-size: 21px; text-align: left; margin-top: 20px; margin-bottom: 20px; display: inline-block; background: #ffaa00; color: #FFF; border-radius: 6px; text-decoration: none; padding: 8px 18px;" href="https://nucleus.vision/token-sale.html" target="_blank">Get more details for token sale</a></p><p style="border-bottom: solid 1px #e5e5e5; margin-bottom: 20px;"></p><p style="font-family: Titillium Web, sans-serif; font-size: 21px; text-align: left; margin-top: 20px;"><b>Cheers,</b><br>Nucleus.Vision</p></div><p style="font-family: Titillium Web, sans-serif; font-size: 16px; text-align: center; margin-top: 30px; color: #FFF;">For more information: &nbsp;&nbsp;<a style="color: #ffaa00; text-decoration: none;" href="mailto:info@nucleus.vision">info@nucleus.vision</a>&nbsp;&nbsp;  |  &nbsp;&nbsp;<a style="color: #ffaa00; text-decoration: none;" href="https://nucleus.vision/" target="_blank">www.nucleus.vision</a></p></body></html>';														
														

require 'vendor/autoload.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'info@nucleus.vision';                 // SMTP username
    $mail->Password = 'Nucleus@123';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('info@nucleus.vision', 'Nucleus Vision');
    //$mail->addAddress('info@nucleus.vision');//, 'Sada');     // Add a recipient
	$mail->addAddress('tokensale@nucleus.vision');//, 'Sada');     // Add a recipient

	/*
    $mail->addAddress('ellen@example.com');               // Name is optional
    $mail->addReplyTo('info@example.com', 'Information');
    $mail->addCC('cc@example.com');
    $mail->addBCC('bcc@example.com');

    //Attachments
    $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
	*/

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $message;

	$servername = "localhost";
	$username = "admin_nucleus";
	$password = "Nucleus@123";
	$dbname = "admin_default";

    $mail->send();
	
	
	//$to = "info@nucleus.vision";
	//$subject = $subject;

	//$body_message = $message;

	// Always set content-type when sending HTML email
	//$headers = "MIME-Version: 1.0" . "\r\n";
	//$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

	// More headers
	//$headers .= 'From: <info@nucleus.vision>' . "\r\n";

	//mail($to,$subject,$body_message,$headers);
	
	$mail->ClearAddresses(); 
	
	//Recipients
    $mail->setFrom('info@nucleus.vision', 'Nucleus Vision');
    $mail->addAddress($email);//, 'Sada');     // Add a recipient
	$mail->Subject = "Welcome to the NUCLEUS Token Sale!";
    $mail->Body    = $user_message;
	$mail->send();
	
	
	//$to_user = $email;
	//$subject_user = "Welcome to the NUCLEUS Token Sale!";

	//$body_message = $user_message;

	// Always set content-type when sending HTML email
	//$headers_user = "MIME-Version: 1.0" . "\r\n";
	//$headers_user .= "Content-type:text/html;charset=UTF-8" . "\r\n";

	// More headers
	//$headers_user .= 'From: <info@nucleus.vision>' . "\r\n";

	//mail($to_user,$subject_user,$body_message,$headers_user);
	
		
	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
		//die("Connection failed: " . mysqli_connect_error());
	}
	
	$cur_time = date('Y-m-d h:i:s');
	
	$sql = "INSERT INTO nucleus_subscribers_list (email, amount, created_at)
	VALUES ('".$email."', '".$amount."', '".$cur_time."')";

	if (mysqli_query($conn, $sql)) {
		//echo "New record created successfully";
	} else {
		//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}

	mysqli_close($conn);
	file_put_contents("emails.txt", $email.':'.$amount . "\n", FILE_APPEND);
	
    echo "success";
} catch (Exception $e) {
    echo "invalid";
}



?>