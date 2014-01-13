<?php
	require('utils.php');
	login();

	if (isset($_GET['action']) && isset($_GET["id"]))
	{
		if ($_GET['action'] == 'join' && !isSignedUpForMeeting($_GET["id"]))
		{
			joinMeeting($_GET["id"]);
		}
		else if ($_GET['action'] == 'signout' && isSignedUpForMeeting($_GET["id"]))
		{
			signOutFromMeeting($_GET["id"]);
		}
	}
?>

<html>
<head>
    <title>View meeting</title>
</head>
<body>
	<div>
		<p>View meeting</p>
		<?php
			@ $id = $_GET["id"];
			if (!isset($id))
			{
				echo 'Error: ID required';
				exit;
			}
			
			@ $db = connectDB();
			$result = $db->query("select * from meeting where id=".$id);
			if ($result->num_rows == 0)
			{
				echo 'Error: Could not find meeting with id $id.';
				exit;
			}
			$row = $result->fetch_assoc();
			
			echo '<label>Theme </label><span id="theme">'.$row['theme'].'</span><br/>';
			echo '<label>City </label><span id="city">'.$row['city'].'</span><br/>';
			echo '<label>Address </label><span id="address">'.$row['address'].'</span><br/>';
			echo '<label>Date </label><span id="startDate">'.$row['startDate'].'</span><br/>';
			echo '<label>Max participants </label><span id="maxParticipants">'.$row['maxParticipants'].'</span><br/>';
			
			if (isSignedUpForMeeting($id))
			{
				echo 'You are signed up for this meeting ';
				echo '<a href="meetingView.php?action=signout&id='.$id.'">Sign out from this meeting</a><br/>';
			}
			else
			{
				echo '<a href="meetingView.php?action=join&id='.$id.'">Join this meeting</a><br/>';
			}
			echo '<a href="meetingEdit.php?id='.$id.'">Edit meeting</a><br/>';
			echo '<a href="personList.php">Client list</a><br/>';
			echo '<a href="meetingList.php">Meeting list</a>';
			
			$result->free();
			$db->close();
		?>
	</div>
</body>
</html>
