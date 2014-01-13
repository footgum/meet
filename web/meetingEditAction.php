<?php	
	$id = $_POST["id"];
	$theme = $_POST["theme"];
    $city = $_POST["city"];
    $address = $_POST["address"];
    $startDate = $_POST["startDate"];
    $maxParticipants = $_POST["maxParticipants"];
	
	if (!isset($id))
	{
		$result["status"] = "Error: ID required";
		echo json_encode($result);
		exit();
	}
	
	require('utils.php');
	@ $db = connectDB();
	if (mysqli_connect_errno()) 
	{
		$result["status"] = "Connect failed: ".mysqli_connect_error();
		echo json_encode($result);
		exit();
	}

	$result = array();
    $query = "update meeting set ".
		"theme = '$theme', ".
		"city = '$city', ".
		"address = '$address', ".
		"startDate = '$startDate', ".
		"maxParticipants = '$maxParticipants' ".
		"where id = $id";

	if($db->query($query)) 
	{
		$result["status"] = "ok";
		$result["id"] = $id;
	}
	else 
	{
		$result["status"] = "Unable to save meeting";
	}
	
	echo json_encode($result);
	
	$db->close();
?>