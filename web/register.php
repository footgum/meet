<?php
	require('utils.php');
	session_start();
	if (isset($_SESSION['valid_user']))
	{
?>
		<html>
			<head>
				<title>Registratrion</title>
			</head>
			<body>
				<p>You are already signed in. To register new account you need to <a href="logout.php">log out</a><p>
			</body>
		</html>

<?php
	}
?>

<html>
	<head>
		<title>Registratrion</title>
	</head>
	<body>
		<form method="post" onsubmit="sendRequest(); return false">
			<p>New client registration:</p>
			<p>First name: <input type="text" id="firstName" name="firstName" value="" /><br />
			Last name: <input type="text" id="lastName" name="lastName" value="" /><br />
			Income: <input type="text" id="income" name="income" value="" /><br />
			E-mail: <input type="text" id="mail" name="mail" value="" /><br />
			Login: <input type="text" id="login" name="login" value="" /><br />
			Password: <input type="text" id="password" name="password" value="" /><br /></p>
			<input id="registerButton" type="submit" value="Create account"/>
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
				$.post('registerAction.php', sBody,
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
	</body>
</html>
