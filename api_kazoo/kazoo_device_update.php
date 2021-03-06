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

    //Get all the devices for this account
    $url = "https://api.zswitch.net:8443/v2/accounts/" . $id . "/devices";
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
    $devices_req = curl_exec($ch);
    curl_close($ch);

    $devices = json_decode($devices_req);
    //var_dump($devices);

    $device_list = array();
    $device_list = $devices->data;

    $arrDevice = array();


    echo "<BR><BR>********<BR><BR>ADDING DEVICES******<BR><BR>";
    foreach ($device_list as $key => $arrDevice) {
        $cntDevice++;

        $deviceId = $arrDevice->id;
        if ($cntDevice == 1) {
            $deviceString = "'" . $deviceId . "'";
        } else {
            $deviceString = $deviceString . ",'" . $deviceId . "'";
        }
        $accountId = $id;
        $name = $arrDevice->name;
        $username = $arrDevice->username;
        $ownerId = $arrDevice->owner_id;
        $enabled = $arrDevice->enabled;
        $deviceType = $arrDevice->device_type;

        if ($enabled) {
            $enabled = 1;
        } else {
            $enabled = 0;
        }

        if (substr($name, 0, 2) == 'X_') {
            $monitored = 0;
            $sql = "INSERT INTO KazooDevices (deviceId, accountId, name, ownerId, enabled,monitored,username) VALUES ('{$deviceId}','{$accountId}','{$name}','{$ownerId}',{$enabled},{$monitored},'{$username}') ON DUPLICATE KEY UPDATE name='{$name}', ownerId='{$ownerId}', enabled={$enabled}, monitored={$monitored}, username='{$username}'";

        } else {
            $monitored = 1;
            $sql = "INSERT INTO KazooDevices (deviceId, accountId, name, ownerId, enabled,monitored,username) VALUES ('{$deviceId}','{$accountId}','{$name}','{$ownerId}',{$enabled},{$monitored},'{$username}') ON DUPLICATE KEY UPDATE name='{$name}', ownerId='{$ownerId}', enabled={$enabled}, username='{$username}'";
            $billableDevices++;
        }
        echo $sql . "<BR>";
        mysql_select_db($db);
        $retval1 = mysql_query($sql, $conn);

    }
}
	

//update the monitor table
$sql = "UPDATE KazooMonitor SET LastDeviceUpdate = '{$now}',deviceCount={$cntDevice}, billableDeviceCount={$billableDevices} WHERE id=1";
mysql_select_db($db);
$retval1 = mysql_query( $sql, $conn );  

//Clean up devices table
if ($cntDevice > 1000) {
	$sql = "DELETE FROM KazooDevices WHERE deviceId NOT IN ({$deviceString});";
	echo $sql;
	mysql_select_db($db);
	$retval1 = mysql_query( $sql, $conn );  
}

$emaillog =  "UPDATE COMPLETE. \n Devices: {$cntDevice}, Billable Devices: {$billableDevices}";
echo $emaillog;
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
mail("jrobs@simplevoip.us", "Kazoo Sync Complete", $emaillog, $headers);

?>