<?php
//include "../inc_db.php";
define('WEB_HOST', 		'orders.simplevoip.us');
define('DB_HOST', 		'sv-mysql.cilqdskq1dv5.us-east-1.rds.amazonaws.com');
define('DB_USER', 		'simplevoip');
define('DB_PASSWORD', 	'1Bigpimp!');
define('DB_NAME', 		'simplevoip');
$dbhost = DB_HOST;
$dbuser = DB_USER;
$dbpass = DB_PASSWORD;
$db 	= DB_NAME;
$conn = mysql_connect($dbhost, $dbuser, $dbpass, $db);


$accountId = $_REQUEST['accountId'];

$sql = "select u.*, l.state as state, l.city as city from KazooUsers u left outer join tblCustomerLocations l on l.siteNumber=u.last_name where first_name not like 'X_%' and accountId IN ('{$accountId}',(select accountId from KazooAccounts where parentAccountId='{$accountId}')) order by state, city, last_name";
mysql_select_db($db);
$sites = mysql_query( $sql, $conn );

$s = "<?xml version=\"1.0\" encoding=\"utf-8\"?> <ppxml xmlns=\"http://panasonic/sip_phone\"\n" .
        "xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"\n" .
        "xsi:schemaLocation=\"http://panasonic/sip_phone sip_phone.xsd\">\n" .
        "<Screen version=\"2.0\">\n" .
        "<PhoneBook version=\"2.0\">\n\n";

$cnt = 0;
while($row = mysql_fetch_array($sites, MYSQL_ASSOC)) {
    $cnt++;
    $state = $row['state'];
    $city = $row['city'];

    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $callerid = $row['callerid'];
    if ($callerid !== $lastcallerid) {
        $name = $state . "-" . $city . " " . $last_name;
        $s .= "<Personnel id='{$cnt}'><Name>'{$name}'</Name><PhoneNums><PhoneNum type='office'>{$callerid}</PhoneNum></PhoneNums></Personnel>\n";

    }
    $lastcallerid = $callerid;
}
$s .= " </PhoneBook></Screen></ppxml> ";

header("Content-Type: text/xml");
//echo $sql;
echo $s;
