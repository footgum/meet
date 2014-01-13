<?php
	require('utils.php');
	login(); 
?>

<html>
<head>
    <title>Update meeting</title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="purl.js"></script>
    <script type="text/javascript">
        
        function sendRequest() 
		{
            var oForm = document.forms[0];
            var sBody = getRequestBody(oForm);
			$.post('meetingEditAction.php', sBody + '&id=' + $.url().param('id'),
			function(response)
			{
				var result = $.parseJSON(response);
				if (result.status == 'ok')
				{
					window.location = 'meetingView.php?id=' + result.id;
				}
				else
				{
					$('#divStatus').text(response.status);
				}
			});
        }
        
        function getRequestBody(oForm) 
		{
            var aParams = new Array();
            for (var i=0 ; i < oForm.elements.length; i++) 
			{
                var sParam = encodeURIComponent(oForm.elements[i].name);
                sParam += "=";
                sParam += encodeURIComponent(oForm.elements[i].value);
                aParams.push(sParam);
            } 
            return aParams.join("&");        
        }
    </script>
</head>
<body>
	<form method="post" onsubmit="sendRequest(); return false">
		<p>Meeting edit:</p>
		<p>
			<?php
				
				@ $id = $_GET["id"];
				if (!isset($id))
				{
					echo 'Error: ID required';
					exit;
				}
				
				@ $db = connectDB();
				if (mysqli_connect_errno()) 
				{
					echo 'Error: Could not connect to database.';
					exit;
				}
				$query = "select * from meeting where id=".$id;
				$result = $db->query($query);
				if ($result->num_rows == 0)
				{
					echo 'Error: Could not find meeting with id $id.';
					exit;
				}
				$row = $result->fetch_assoc();
				echo 'Theme: <input type="text" id="theme" name="theme" value="'.$row['theme'].'" /><br />';
				echo 'City: <input type="text" id="city" name="city" value="'.$row['city'].'" /><br />';
				echo 'Address: <input type="text" id="address" name="address" value="'.$row['address'].'" /><br />';
				echo 'Date: <input type="text" id="startDate" name="startDate" value="'.$row['startDate'].'" /><br />';
				echo 'Max participants: <input type="text" id="maxParticipants" name="maxParticipants" value="'.$row['maxParticipants'].'" /><br />';
				
				$result->free();
				$db->close();
			?>
		</p>
		<input id="registerButton" type="submit" value="Save"/>
		<input id="cancelButton" type="button" value="Cancel"/>
    </form>
    <div id="divStatus"></div>
	
	<script>
		$(document).ready(function() 
		{
			$('#cancelButton').click(function(event)
			{
				event.preventDefault();
				window.location = <?php echo "'meetingView.php?id=".$id."'"; ?>;
			});
		});
	</script>
</body>
</html>
