<?php
	require('utils.php');
	login(); 
?>

<html>
<head>
    <title>View profile</title>
</head>
<body>
	<div>
		<p>View profile</p>
		<?php
				@ $personid = $_GET["id"];
				if (!isset($personid))
				{
					echo 'Error: ID required';
					exit;
				}
				
				@ $db = connectDB();
				if (mysqli_connect_errno()) 
				{
					echo 'Error: Could not connect to database. Please try again later.';
					exit;
				}
				$query = "select * from person where id=".$personid;
				$result = $db->query($query);
				if ($result->num_rows == 0)
				{
					echo 'Error: Could not find client with id $personid.';
					exit;
				}
				$row = $result->fetch_assoc();
			
			echo '<label>First name </label><span id="firstName">'.$row['firstname'].'</span><br/>';
			echo '<label>Last name </label><span id="lastName">'.$row['lastname'].'</span><br/>';
			echo '<label>Income </label><span id="income">'.$row['income'].'</span><br/>';
			echo '<label>E-mail </label><span id="mail">'.$row['mail'].'</span><br/>';
			
			echo '<a href="profileEdit.php?id='.$personid.'">Edit profile</a><br/>';
			echo '<a href="personList.php">Client list</a>';
			
			$result->free();
			$db->close();
		?>
	</div>
</body>
</html>
