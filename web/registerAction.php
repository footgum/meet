<?php

    session_start();
	header("Content-Type: text/plain");
    
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $income = $_POST["income"];
    $mail = $_POST["mail"];
    $login = $_POST["login"];
    $password = $_POST["password"];
	
	$result = array();


    $sql = "insert into person(firstname, lastname, income, mail, login, password) ".
            "values ('$firstName','$lastName','$income','$mail', '$login', sha1('$password'))";
			
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
		$_SESSION['valid_user'] = $login;
	}
	else 
	{
		$result["status"] = "Unable to save client";
	}
    
    echo json_encode($result);
	
	$db->close();
?>