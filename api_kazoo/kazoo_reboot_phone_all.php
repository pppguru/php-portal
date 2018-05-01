<?php
include 'kazoo_token.php';
include "inc_db.php";
//error_reporting(E_ALL | E_STRICT);
//ini_set('display_errors', 'On');

	date_default_timezone_set('America/Chicago');
	$now = date("Y-m-d H:i:s");

	$accountId = '';
	



	//loop through a bunch
	$sql = "SELECT * from KazooDevices where accountId in ('{$accountId}') ";
	mysql_select_db($db);
	$devices = mysql_query( $sql, $conn );  

	echo $sql;
	while($row = mysql_fetch_array($devices, MYSQL_ASSOC)) {
		$deviceId = $row['deviceId'];
		$name = $row['name'];
		$url = "https://api.zswitch.net:8443/v2/accounts/" . $accountId ."/devices/" . $deviceId . "/sync";
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HTTPHEADER,
		  array(
				'Accept: application/json',
				'Content-Type: application/json', 
				'X-Auth-Token: ' . $auth_token
			   )
		);   
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	
		$devices_req = curl_exec($ch);
		$response = json_decode($devices_req);	
		$status = $response->status;	
		curl_close($ch);
		echo "Reboot Sent for {$name}. Status: {$status} <BR>";
	}
	
mysql_close();

?>