<?php	
	$personid = $_POST["id"];
	$firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $income = $_POST["income"];
    $mail = $_POST["mail"];
	
	if (!isset($personid))
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
    $query = "update person set ".
		"firstname = '$firstName', ".
		"lastname = '$lastName', ".
		"income = '$income', ".
		"mail = '$mail' ".
		"where id = $personid";

	if($db->query($query)) 
	{
		$result["status"] = "ok";
		$result["id"] = $personid;
	}
	else 
	{
		$result["status"] = "Unable to save client";
	}
	
	echo json_encode($result);
	
	$db->close();
?>