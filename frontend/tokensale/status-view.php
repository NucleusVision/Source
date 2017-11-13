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
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/sweetalert.min.js"></script>
    <script src="js/form-scripts.js"></script>
    <script src="js/app.js"></script>
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
					margin-bottom: 100px;
                 }
                 .mrt250{
                     margin-top: 200px;
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
                <h2 align="center">Nucleus Token Sale Registration Status</h2>
				<?php
				$color='blue';
                if(isset($_SESSION['status'])){
					if($_SESSION['status'] == 'Approved'){
						$color = 'green';
					}elseif($_SESSION['status'] == 'Rejected'){
						$color = 'yellow';
					}
				}
				?>
                <h2 align="center">Your current status is:<br><br/><b class="<?php echo $color; ?>"><?php if(isset($_SESSION['status'])){ echo $_SESSION['status']; unset($_SESSION['status']); }else{ header('Location: status.php'); }   ?></b></h2>      
              </form>
            </div>
            <p align="center" class="mrt200"><a href="#" class="yellow-link">Privacy Policy</a><br>&copy; 2014 Nucleus Vision (formerly Bell Boi, Inc.)</p>
        </div>    
      </div>
    </div>
  </body>
</html>