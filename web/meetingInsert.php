<?php
	require('utils.php');
	login(); 
?>

<html>
	<head>
		<title>New meeting</title>
	</head>
	<body>
		<form method="post" onsubmit="sendRequest(); return false">
			<p>New meeting</p>
			<p>Meeting theme: <input type="text" id="theme" name="theme" value="" /><br />
			City: <input type="text" id="city" name="city" value="" /><br />
			Address: <input type="text" id="address" name="address" value="" /><br />
			Date: <input type="text" id="startDate" name="startDate" value="" /><br />
			Max participants: <input type="text" id="maxParticipants" name="maxParticipants" value="" /><br /></p>
			<input id="submitButton" type="submit" value="Create meeting"/>
			<input id="cancelButton" type="button" value="Cancel"/>
		</form>
		<div id="divStatus"></div>
		
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script>
			$(document).ready(function() 
			{
				$('#cancelButton').click(function(event)
				{
					event.preventDefault();
					window.location = 'personList.php';
				});
			});
			
			function sendRequest() 
			{
	            var oForm = document.forms[0];
	            var sBody = getRequestBody(oForm);
				$.post('meetingInsertAction.php', sBody,
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
	</body>
</html>
