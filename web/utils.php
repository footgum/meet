<?php 
	function connectDB()
	{
		return new mysqli('localhost', 'root', '', 'test');
	}
?>