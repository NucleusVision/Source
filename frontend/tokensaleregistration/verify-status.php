<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Nucleus - Token Sale</title>  
    <link rel="stylesheet" href="css/global.css">
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="icon" href="img/favicon.png" type="image/png" sizes="16x16">
    <!-- Global Site Tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-107563572-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-107563572-1');
    </script>
    <style>
		.text-xs-center {
			text-align: center;
		}
                .nucleus-logo {
                    max-height: 100px;
                    width: auto;
                    margin-top: 10px;
                    text-align: center;
                }
                .tsr-container{
                    margin-top: 10px;
                 }
                 .mrt250{
                     margin-top: 250px;
                 }
	</style> 
  </head>
  <body class="all-sections-bg">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6 align-self-center">
            <div class="tsr-container">
              <form>
                <p align="center"><img src="img/nucleus-icon.png" class="nucleus-logo"></p>
                <h2 align="center">Nucleus Token Sale</h2>
				<?php
				$color='blue';
                if(isset($_SESSION['verify-status'])){
					if($_SESSION['verify-status'] == 'Your email has been verified successfully.' || $_SESSION['verify-status'] == 'Your have already verified your email.'){
						$color = 'green';
					}elseif($_SESSION['verify-status'] == 'Rejected'){
						$color = 'yellow';
					}
				}
				?>
                <h2 align="center" class="mrt50"><b class="<?php echo $color; ?>"><?php if(isset($_SESSION['verify-status'])){ echo $_SESSION['verify-status']; unset($_SESSION['verify-status']); }else{ header('Location: index.php'); }   ?></b></h2>      
              </form>
			  <?php if($color == 'green'){ ?>
			  <h2 align="center" class="mrt50">We will keep you posted on the next steps.</h2>      
			  <?php } ?>
            </div>
            <p align="center" class="mrt250"><a href="#" class="yellow-link">Privacy Policy</a><br>&copy; 2014 Nucleus Vision (formerly Bell Boi, Inc.)</p>
        </div>    
      </div>
    </div>
  </body>
</html>