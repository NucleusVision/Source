<html>
<head>
<title>Nucleus Data</title>
<link href="css/bootstrap.min.css" rel="stylesheet">   
        <script src="js/jquery.min.js"></script>
        <link rel="stylesheet" href="css/jquery.dataTables.min.css">
        <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <style>
            #redemption_menu{
                list-style: none;
                display: inline;
            }
            #redemption_menu li {
                display: inline;
                margin-right: 10px;
            }
        </style>
</head>

<body>

<?php

error_reporting(0);

$response = "";

$servername = "localhost";
$username = "root";
$password = "";
//$username = "admin_nucleus";
//$password = "Nucleus@123";
$dbname = "admin_nucleus_vision";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
	//die("Connection failed: " . mysqli_connect_error());
}

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
	
	$u_ids = $_POST['u_ids'];
	$li_sensors = $_POST['li_sensors'];
	$s_auth = $_POST['s_auth'];
	$r_sent = $_POST['r_sent'];
	$b_availed = $_POST['b_availed'];
	$temp1 = $_POST['temp1'];
	$temp2 = $_POST['temp2'];
	$temp3 = $_POST['temp3'];
		
	$sql = "UPDATE `nucleus_vision_tracker` SET `imei_caputured`='".$u_ids."',`sensors_count`='".$li_sensors."',`authorizations`='".$s_auth."',`recommendations`='".$r_sent."',`benefits_availed`='".$b_availed."',`temp1`='".$temp1."',`temp2`='".$temp2."',`temp3`='".$temp3."' WHERE `id`=1";

	if (mysqli_query($conn, $sql)) {
		$response = "Data Updated successfully";
	} else {
		$response = "Error While Updating Please Try Again.";
		//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
			
}

$n_data_qry = "select * from nucleus_vision_tracker where id = 1";
$Qry = mysqli_query($conn, $n_data_qry) or die(mysqli_error($conn));
$count = mysqli_num_rows($Qry);
if($count>0){
	$ndata = mysqli_fetch_array($Qry, MYSQLI_ASSOC);
	//var_dump($ndata);
	
}
mysqli_close($conn);
?>

<p style="margin-top: 40px;text-align:center;" align="center"><img src="https://nucleus.vision/img/logo-color.png"><br/><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></p>
<table width="600" style="margin:30px auto; background:#f8f8f8; border:1px solid #eee; padding:10px;">

<form action="" method="post">



<tr><td colspan="2" style="font:bold 15px arial; text-align:center; padding:0 0 5px 0;">Nucleus Data QA</td></tr>

<tr>

<td width="50%" style="font:bold 12px tahoma, arial, sans-serif; text-align:right; border-bottom:1px solid #eee; padding:5px 10px 5px 0px; border-right:1px solid #eee;">Unique Ids</td>

<td width="50%" style="border-bottom:1px solid #eee; padding:5px;"><input type="text" name="u_ids" id="u_ids" value="<?php echo $ndata['imei_caputured']; ?>" /></td>

</tr>

<tr>

<td width="50%" style="font:bold 12px tahoma, arial, sans-serif; text-align:right; border-bottom:1px solid #eee; padding:5px 10px 5px 0px; border-right:1px solid #eee;">Live ION Sensors</td>

<td width="50%" style="border-bottom:1px solid #eee; padding:5px;"><input type="text" name="li_sensors" id="li_sensors" value="<?php echo $ndata['sensors_count']; ?>" /></td>

</tr>

<tr>

<td width="50%" style="font:bold 12px tahoma, arial, sans-serif; text-align:right; border-bottom:1px solid #eee; padding:5px 10px 5px 0px; border-right:1px solid #eee;">Successful Authorization</td>

<td width="50%" style="border-bottom:1px solid #eee; padding:5px;"><input type="text" name="s_auth" id="s_auth" value="<?php echo $ndata['authorizations']; ?>" /></td>

</tr>

<tr>

<td width="50%" style="font:bold 12px tahoma, arial, sans-serif; text-align:right; border-bottom:1px solid #eee; padding:5px 10px 5px 0px; border-right:1px solid #eee;">Benefits Availed</td>

<td width="50%" style="border-bottom:1px solid #eee; padding:5px;"><input type="text" name="r_sent" id="r_sent" value="<?php echo $ndata['recommendations']; ?>" /></td>

</tr>


<tr>

<td width="50%" style="font:bold 12px tahoma, arial, sans-serif; text-align:right; border-bottom:1px solid #eee; padding:5px 10px 5px 0px; border-right:1px solid #eee;">Benefits Availed</td>

<td width="50%" style="border-bottom:1px solid #eee; padding:5px;"><input type="text" name="b_availed" id="b_availed" value="<?php echo $ndata['benefits_availed']; ?>" /></td>

</tr>


<tr>

<td width="50%" style="font:bold 12px tahoma, arial, sans-serif; text-align:right; border-bottom:1px solid #eee; padding:5px 10px 5px 0px; border-right:1px solid #eee;">Temp1</td>

<td width="50%" style="border-bottom:1px solid #eee; padding:5px;"><input type="text" name="temp1" id="temp1" value="<?php echo $ndata['temp1']; ?>" /></td>

</tr>


<tr>

<td width="50%" style="font:bold 12px tahoma, arial, sans-serif; text-align:right; border-bottom:1px solid #eee; padding:5px 10px 5px 0px; border-right:1px solid #eee;">Temp2</td>

<td width="50%" style="border-bottom:1px solid #eee; padding:5px;"><input type="text" name="temp2" id="temp2" value="<?php echo $ndata['temp2']; ?>" /></td>

</tr>


<tr>

<td width="50%" style="font:bold 12px tahoma, arial, sans-serif; text-align:right; border-bottom:1px solid #eee; padding:5px 10px 5px 0px; border-right:1px solid #eee;">Temp3</td>

<td width="50%" style="border-bottom:1px solid #eee; padding:5px;"><input type="text" name="temp3" id="temp3" value="<?php echo $ndata['temp3']; ?>" /></td>

</tr>



<tr>

<td style="font:bold 12px tahoma, arial, sans-serif; text-align:right; padding:5px 10px 5px 0px; border-right:1px solid #eee;"></td>

<td width="50%" style=" padding:5px;"><input type="submit" name="submit" /></td>

</tr>


<tr>

<td style="font:bold 12px tahoma, arial, sans-serif; text-align:right; padding:5px 10px 5px 0px; border-right:1px solid #eee;"></td>

<td width="50%" style=" padding:5px;"><?php  if(isset($response)){ echo $response; } ?></td>

</tr>


</table>

   
</form>

</body>

</html>