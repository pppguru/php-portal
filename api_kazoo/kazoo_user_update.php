<?php
include 'kazoo_token.php';
//error_reporting(E_ALL | E_STRICT);
//ini_set('display_errors', 'On');

date_default_timezone_set('UTC');
$now = date("Y-m-d H:i:s");

//set_time_limit (980);

include "inc_db.php";

//Get accounts
$sql = "SELECT * from KazooAccounts";
mysql_select_db($db);
$accounts = mysql_query( $sql, $conn );  


while($row = mysql_fetch_array($accounts, MYSQL_ASSOC)) {
	$id = $row['accountId'];
    $accountId = $id;

	
	//Get all the users for this account
	$url = "https://api.zswitch.net:8443/v2/accounts/" . $id ."/users";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HTTPHEADER,
	  array(
			'Accept: application/json',
			'Content-Type: application/json', 
			'X-Auth-Token: ' . $auth_token
		   )
	);   
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_VERBOSE, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$users_req = curl_exec($ch);
	curl_close($ch);

	$users = json_decode($users_req);
    //var_dump($users);
	
	$users_list = array();
	$users_list = $users->data;
	
	$arrUsers = array();
	
	echo "<BR><BR>********<BR><BR>ADDING USERS******<BR><BR>";
	foreach ($users_list as $key => $arrUsers) {
		$cntUser++;
		
		$userId = $arrUsers->id;
		$first_name = $arrUsers->first_name;
		$last_name = $arrUsers->last_name;
		$email = $arrUsers->email;
		$timezone = $arrUsers->timezone;

        if ($cntUser==1) {
            $userString = "'" . $userId . "'";
        } else {
            $userString = $userString . ",'" . $userId . "'";
        }
		
		//Now get the user details
		$url = "https://api.zswitch.net:8443/v2/accounts/" . $id ."/users/" . $userId;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HTTPHEADER,
		  array(
				'Accept: application/json',
				'Content-Type: application/json', 
				'X-Auth-Token: ' . $auth_token
			   )
		);   
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$user_req = curl_exec($ch);
		curl_close($ch);

		$user = json_decode($user_req);
		$user_data = array();
		$user_data = $user->data;
	
		$callerid = $user->data->caller_id->external->number;
		
		$sql = "INSERT INTO KazooUsers (userId, first_name, last_name, email, timezone, callerid, accountId) VALUES ('{$userId}','{$first_name}','{$last_name}','{$email}','{$timezone}','{$callerid}','{$accountId}') ON DUPLICATE KEY UPDATE first_name='{$first_name}', last_name='{$last_name}',email='{$email}',timezone='{$timezone}',callerid='{$callerid}', accountId='{$accountId}';";
		echo $sql . "<BR>";
		mysql_select_db($db);
		$retval1 = mysql_query( $sql, $conn );  
	
	}	

}

//update the monitor table
$sql = "UPDATE KazooMonitor SET LastUserUpdate = '{$now}', userCount={$cntUser} WHERE id=1";
mysql_select_db($db);
$retval1 = mysql_query( $sql, $conn );  

if ($cntUser > 500) {
    $sql = "DELETE FROM KazooUsers WHERE userId NOT IN ({$userString});";
    echo $sql;
    mysql_select_db($db);
    $retval1 = mysql_query( $sql, $conn );
}

$emaillog =  "UPDATE COMPLETE. \n Users: {$cntUser}";
echo $emaillog;
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
mail("jrobs@simplevoip.us", "Kazoo Sync Complete", $emaillog, $headers);
?>