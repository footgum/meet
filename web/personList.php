<?php
	require('utils.php');
	login(); 
?>

<html>
<head>
<title>All persons</title>

<link href="meet.css" rel="stylesheet"/>
</head>
<body>
	<a href="register.php">Register new person</a><br/>
	<a href="meetingList.php">Meetings list</a><br/>
	<a href="meetingInsert.php">Create meeting</a>
	
	<table class="table table-hover">
		<thead>
			<tr>
				<th>ID</th>
				<th>First name</th>
				<th>Last name</th>
				<th>Income</th>
				<th>E-mail</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				@ $db = connectDB();
				if (mysqli_connect_errno()) 
				{
					echo 'Error: Could not connect to database. Please try again later.';
					exit;
				}
				
				@$searchString = $_GET['search'];
				$whereClause = '';
				if (!is_null($searchString))
				{
					$whereClause = " where firstname like '%".$searchString."%' ".
					"or lastname like '%".$searchString."%' ".
					"or mail like '%".$searchString."%'";
				}
				
				$query = 'select * from person'.$whereClause;
				$result = $db->query($query);
				$num_results = $result->num_rows;
				//echo "<p>Number of books found: ".$num_results."</p>";
				for ($i=0; $i < $num_results; $i++)
				{
					$row = $result->fetch_assoc();
					echo '<tr class="'.($i % 2 == 0 ? 'row1' : 'row2').'"'.
						'onclick="window.location = \'profileView.php?id='.$row['id'].'\'"'.'>';
					echo '<td>'.$row['id'].'</td>';
					echo '<td>'.$row['firstname'].'</td>';
					echo '<td>'.$row['lastname'].'</td>';
					echo '<td>'.$row['income'].'</td>';
					echo '<td>'.$row['mail'].'</td>';
					echo '</tr>';
				}
				$result->free();
				$db->close();
			?>
		</tbody>
	</table>

</body>
</html>