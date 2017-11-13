<?php
$servername = "localhost";
$username = "root";
$password = "";

$connection_successful = 0;

try 
{
    $conn = new PDO("mysql:host=$servername;dbname=admin_nucleus_vision", $username, $password);
    // set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//echo "Connected successfully";

	$connection_successful = 1;
}
catch(PDOException $e)
{
    //echo "Connection failed: " . $e->getMessage();
}

if($connection_successful == 1)
{

	$return  = array();
	//$qry = "select sum(imei_caputured) as imei_count, sum(sensors_count) as sensors_count, sum(authorizations) as authorizations, sum(recommendations) as recommendations, sum(benefits_availed) as benefits_availed from nucleus_vision_tracker order by id desc";
        $qry = "select imei_caputured as imei_count, sensors_count as sensors_count, authorizations as authorizations, recommendations as recommendations, benefits_availed as benefits_availed,temp1,temp2,temp3 from nucleus_vision_tracker order by id desc";
	$query = $conn->prepare($qry);
	$query->execute();
	$cnt = $query->rowCount();

	//echo "<br>Count : $cnt </br>";
	//exit;

	if($cnt > 0)
	{
		while($res = $query->fetchobject())
		{
			$return[] = $res;
		}
	}
	
	echo json_encode($return);
}

?>