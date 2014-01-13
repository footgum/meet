<?php
	require('utils.php');
	login(); 
?>

<html>
<head>
<title>Meeting list</title>

<link href="meet.css" rel="stylesheet"/>
</head>
<body>
	<a href="meetingInsert.php">Create meeting</a><br/>
	<a href="personList.php">Client list</a>
	
	<table class="table table-hover">
		<thead>
			<tr>
				<th>ID</th>
				<th>Theme</th>
				<th>City</th>
				<th>Address</th>
				<th>Date</th>
				<th>Max participants</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				@ $db = connectDB();
				if (mysqli_connect_errno()) 
				{
					echo 'Error: Could not connect to database.';
					exit;
				}
				
				@$searchString = $_GET['search'];
				$whereClause = '';
				if (!is_null($searchString))
				{
					$whereClause = " where theme like '%".$searchString."%' ".
					"or city like '%".$searchString."%' ".
					"or address like '%".$searchString."%'";
				}
				
				$query = 'select * from meeting'.$whereClause;
				$result = $db->query($query);
				$num_results = $result->num_rows;
				
				for ($i=0; $i < $num_results; $i++)
				{
					$row = $result->fetch_assoc();
					echo '<tr class="'.($i % 2 == 0 ? 'row1' : 'row2').'"'.
						'onclick="window.location = \'meetingView.php?id='.$row['id'].'\'"'.'>';
					echo '<td>'.$row['id'].'</td>';
					echo '<td>'.$row['theme'].'</td>';
					echo '<td>'.$row['city'].'</td>';
					echo '<td>'.$row['address'].'</td>';
					echo '<td>'.$row['startDate'].'</td>';
					echo '<td>'.$row['maxParticipants'].'</td>';
					echo '</tr>';
				}
				$result->free();
				$db->close();
			?>
		</tbody>
	</table>

</body>
</html>