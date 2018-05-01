<?php

	include "inc_db.php";
	session_start();

	date_default_timezone_set('America/Chicago');

	if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != 'YES')
	{
		$url = "index.php?msg=Please log in to access the SimpleVoIP Orders System.";
		Header("Location: $url");
		exit();
	}
?>
