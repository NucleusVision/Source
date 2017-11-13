<?php
	ob_start();
	session_start();
	//require_once 'config.php';
	
	// it will never let you open index(login) page if session is set
	if ( isset($_SESSION['user'])!="" ) {
		header("Location: nucleusdata.php");
		exit;
	}
	
	$error = false;
	
	if( isset($_POST['btn-login']) ) {	
		
		// prevent sql injections/ clear user invalid inputs
		$email = trim($_POST['email']);
		$email = strip_tags($email);
		$email = htmlspecialchars($email);
		
		$pass = trim($_POST['pass']);
		$pass = strip_tags($pass);
		$pass = htmlspecialchars($pass);
		// prevent sql injections / clear user invalid inputs
		
		if(empty($email)){
			$error = true;
			$emailError = "Please enter your email address.";
		} else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
			$error = true;
			$emailError = "Please enter valid email address.";
		}
		
		if(empty($pass)){
			$error = true;
			$passError = "Please enter your password.";
		}
		
		/*
		// if there's no error, continue to login
		if (!$error) {
			
			$password = hash('sha256', $pass); // password hashing using SHA256
		
			$res=mysqli_query($link, "SELECT name, email, password FROM users WHERE email='$email'");
                        $count = mysqli_num_rows($res); // if uname/pass correct it returns must be 1 row
                        
                        if($count > 0){
                        
                            $row=mysqli_fetch_array($res);

                            if( password_verify($pass, $row['password']) ) {//&& $row['userPass']==$password 
                                    $_SESSION['user'] = $row['name'];
                                    header("Location: view.php");
                            } else {
                                    $errMSG = "Incorrect Credentials, Try again...";
                            }
                        } else {
                                    $errMSG = "Incorrect Credentials, Try again...";
                        }
				
		}
		*/
		
		
		if($email == 'admin@nucleus.vision' && $pass == 'Nucleus@123') {//&& $row['userPass']==$password 
			$_SESSION['user'] = $row['name'];
			header("Location: nucleusdata.php");
		} else {
			$errMSG = "Incorrect Credentials, Try again...";
		}
		
		
		//header("Location: nucleusdata.php");
		
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Nucleus Login</title>
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"  />

<style>

/* CSS Document */
*{
	margin:0;
	padding:0;
}
#login-form {
	margin:2% auto;
	max-width:500px;
}
/* home page */
#wrapper{
	padding-top:50px;
}
</style>

</head>
<body>

<div class="container">
	<p style="margin-top: 40px;text-align:center;" align="center"><img src="https://nucleus.vision/img/logo-color.png"></p>
	<div id="login-form">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
    
    	<div class="col-md-12">
        
        	<div class="form-group">
            	<h2 class="">Sign In.</h2>
            </div>
        
        	<div class="form-group">
            	<hr />
            </div>
            
            <?php
			if ( isset($errMSG) ) {
				
				?>
				<div class="form-group">
            	<div class="alert alert-danger">
				<span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                </div>
            	</div>
                <?php
			}
			?>
            
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                <input type="email" name="email" class="form-control" placeholder="Your Email" value="<?php if(isset($emailError)){ echo $email; } ?>" maxlength="40" required />
                </div>
                <span class="text-danger"><?php if(isset($emailError)){ echo $emailError; } ?></span>
            </div>
            
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
            	<input type="password" name="pass" class="form-control" placeholder="Your Password" maxlength="15" required />
                </div>
                <span class="text-danger"><?php if(isset($passError)){ echo $passError; } ?></span>
            </div>
            
            <div class="form-group">
            	<hr />
            </div>
            
            <div class="form-group">
            	<button type="submit" class="btn btn-block btn-primary" name="btn-login">Sign In</button>
            </div>
            
            <div class="form-group">
            	<hr />
            </div>
            
        
        </div>
   
    </form>
    </div>	

</div>

</body>
</html>
<?php ob_end_flush(); ?>