<?php

    header("Content-Type: text/plain");
    
    $theme = $_POST["theme"];
    $city = $_POST["city"];
    $address = $_POST["address"];
    $startDate = $_POST["startDate"];
    $maxParticipants = $_POST["maxParticipants"];
    
    $sStatus = "";
	
	$result = array();


    $sql = "insert into meeting(theme, city, address, startDate, maxParticipants) ".
            "values ('$theme','$city','$address','$startDate','$maxParticipants')";
			
	require('utils.php');
	@ $db = connectDB();
	if (mysqli_connect_errno()) 
	{
		$result["status"] = "Connect failed: ".mysqli_connect_error();
		echo json_encode($result);
		exit();
	}

	if($db->query($sql))
	{
		$result["status"] = "ok";
		$result["id"] = $db->insert_id;
	}
	else
	{
		$result["status"] = "Unable to save meeting";
	}
    
    echo json_encode($result);
	
	$db->close();
?>