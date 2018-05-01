<?php
	include 'consts.php';
	
	$dbhost = DB_HOST;
	$dbuser = DB_USER;
	$dbpass = DB_PASSWORD;
	$db 	= DB_NAME;
	$conn = mysql_connect($dbhost, $dbuser, $dbpass, $db);
	
	if(! $conn )
	{
	  die('Could not connect MAIN: ' . mysql_error());
	}


?>