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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = clean_data($_POST['email']);
    $doc_id = clean_data($_POST['doc_id']);
    $captcha = $_POST['g-recaptcha-response'];
    //var_dump($_POST);exit;
    //$secretKey = "6LegUjYUAAAAAG_lvOTZeN_JIXIewR2v_ZkjbYgh";//original
    $secretKey = "6LeTxTcUAAAAAGwy89ptRBrmGPPNFrOXmSEGeC69";//halcyon.user
    $ip = $_SERVER['REMOTE_ADDR'];
    $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
    $response = json_decode($response, true);
    if($response["success"] === true)
    {    
        $investor_sql = "SELECT email, status FROM investors WHERE email='".$email."' and id_num='".$doc_id."'";
        $investor_result = mysqli_query($conn, $investor_sql);

        if (mysqli_num_rows($investor_result) > 0) {
            $investor_row = mysqli_fetch_array($investor_result, MYSQLI_ASSOC);
			$_SESSION["status"] = $investor_row['status'];
            header('Location: status-view.php');
        } else {
            $message = "Invalid Email ID or Document ID.";
        }    
    }
    else
    {
        $message = "Failed to verify ReCaptcha";
    }

    }
}catch(\Exception $e){
        $message = "The server is currently busy. Please try again later.";
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Nucleus - Token Sale</title>  
    <link rel="stylesheet" href="css/global.css">
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/sweetalert.min.js"></script>
    <script src="js/form-scripts.js"></script>
    <script src="js/app.js"></script>
    <link rel="icon" href="img/favicon.png" type="image/png" sizes="16x16">
	<style>
		.text-xs-center {
			text-align: center;
		}

		.g-recaptcha{
			margin: 15px auto !important;
			width: auto !important;
			height: auto !important;
			text-align: -webkit-center;
			text-align: -moz-center;
			text-align: -o-center;
			text-align: -ms-center;
		}
                .nucleus-logo {
                    max-height: 100px;
                    width: auto;
                    margin-top: 20px;
                    text-align: center;
                }
                .tsr-container{
                    margin-top: 0px;
                 }
                 .form-control {
                    height: 35px;
                }
	</style> 
    <!-- Global Site Tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-107563572-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-107563572-1');
    </script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
  </head>
  <body class="all-sections-bg">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6 align-self-center">
            <div class="tsr-container">
                <form action="status.php" id="status-form" method="post">
                    <p align="center"><img src="img/nucleus-icon.png" class="nucleus-logo"></p>
                <h2 align="center">Nucleus Token Sale Registration Status</h2> 
                <div style="width:500px;margin:auto;margin-top:10px;">
                <p class="mrt10">
                 
                <?php if(isset($message) && !empty($message)){    ?>
                <div class="alert alert-danger alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                     <?php echo $message; ?>
                </div>
                <?php } ?>
                <b>Email ID</b><br>
                <input type="text" name="email" class="form-control" placeholder="email@example.com"></p>
                <p>
                <b>Document ID</b><br>
                Provide your passport ID , driver's license number or national registration identity card number used when you registered.<br><br>
                <input type="text" name="doc_id" class="form-control" placeholder="Document ID"></p>
                <p><div class="g-recaptcha" data-sitekey="6LegUjYUAAAAAOIptlp4CQGTVIFH6APqe8AhCIVs"></div></p>            
                <button type="submit" class="btn btn-lg btn-block btn-bb" id="form-submit">Submit</button>
              </form>
                <div>
            </div>
            <p align="center" class="mrt60"><a href="#" class="yellow-link">Privacy Policy</a><br>&copy; 2014 Nucleus Vision (formerly Bell Boi, Inc.)</p>
            </div>    
      </div>
    </div>
  </body>
</html>

<script>
   
</script>