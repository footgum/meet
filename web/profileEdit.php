<html>
<head>
    <title>Update profile</title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="purl.js"></script>
    <script type="text/javascript">
        
        function sendRequest() 
		{
            var oForm = document.forms[0];
            var sBody = getRequestBody(oForm);
			$.post('saveProfile.php', sBody + '&id=' + $.url().param('id'),
			function(response)
			{
				var result = $.parseJSON(response);
				if (result.status == 'ok')
				{
					window.location = 'profileView.php?id=' + result.id;
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
		<p>Profile edit:</p>
		<p>
			<?php
				
				@ $personid = $_GET["id"];
				if (!isset($personid))
				{
					echo 'Error: ID required';
					exit;
				}
				
				require('utils.php');
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
				echo 'First name: <input type="text" id="firstName" name="firstName" value="'.$row['firstname'].'" /><br />';
				echo 'Last name: <input type="text" id="lastName" name="lastName" value="'.$row['lastname'].'" /><br />';
				echo 'Income: <input type="text" id="income" name="income" value="'.$row['income'].'" /><br />';
				echo 'E-mail: <input type="text" id="mail" name="mail" value="'.$row['mail'].'" /><br />';
				
				$result->free();
				$db->close();
			?>
		</p>
		<p><input id="registerButton" type="submit" value="Save"/></p>
    </form>
    <div id="divStatus"></div>
</body>
</html>
