<?php
	
	
	$dbhost = 'sv-mysql.cilqdskq1dv5.us-east-1.rds.amazonaws.com';
	$dbuser = 'simplevoip';
	$dbpass = '1Bigpimp!';
	$db 	= 'simplevoip';
	$conn = mysql_connect($dbhost, $dbuser, $dbpass);
	
	if(! $conn )
	{
	  die('Could not connect MAIN: ' . mysql_error());
	}


?>
