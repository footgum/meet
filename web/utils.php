<?php 
	function connectDB()
	{
		@ $db = new mysqli('localhost', 'root', '', 'test');
		if (mysqli_connect_errno()) 
		{
			echo 'Error: Could not connect to database.'.mysqli_connect_errno();
			exit;
		}
		return $db;
	}
	
	function isSignedUpForMeeting($meetingid)
	{
		@ $db = connectDB();
		$result = $db->query("select * from meetingparticipant ".
							"where personid = (select id from person where login = '".
							$_SESSION['valid_user']."') and ".
							"meetingid = $meetingid");
		if (!$result)
		{
			echo $db->error;
			exit;
		}
		return $result->num_rows;
	}
	
	function joinMeeting($meetingid)
	{
		@ $db = connectDB();
		$db->query("insert into meetingparticipant (meetingid, personid) ".
				"values ($meetingid, (select id from person where login = '".$_SESSION['valid_user']."'))");
	}
	
	function signOutFromMeeting($meetingid)
	{
		@ $db = connectDB();
		$db->query("delete from meetingparticipant ".
				"where meetingid = $meetingid and ".
				"personid = (select id from person where login = '".$_SESSION['valid_user']."')");
	}
	
	function login()
	{
		session_start();
		if (isset($_POST['login']) && isset($_POST['password']))
		{
			$login = $_POST['login'];
			$password = $_POST['password'];
			@ $db = connectDB();
			$query = 'select * from person '
			."where login='$login' "
			." and password=sha1('$password')";
			$result = $db->query($query);
			if ($result->num_rows)
			{
				$_SESSION['valid_user'] = $login;
			}
			$db->close();
		}
		
		if (isset($_SESSION['valid_user']))
		{
			echo 'Current user: '.$_SESSION['valid_user'].'<br/>';
			echo '<a href="logout.php">Log out</a><br/>';
			return;
		}
		else if (isset($login))
		{
			echo 'Could not log you in.<br />';
		}
		else
		{
			echo 'You are not logged in.<br />';
		}
		?>
		<html>
			<head><title>Log in</title></head>
			<body>
				<form method="post" action="personList.php">
					<table>
					<tr><td>Login:</td>
					<td><input type="text" name="login"></td></tr>
					<tr><td>Password:</td>
					<td><input type="password" name="password"></td></tr>
					<tr><td colspan="2" align="center">
					<input type="submit" value="Log in"></td></tr>
					</table>
				</form>
				<a href="register.php">Create account</a>
			</body>
		</html>
<?php
		exit;
	}
?>