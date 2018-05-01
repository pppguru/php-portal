<?php 

//Define the environment (development, staging and production)
$hostName = strtolower($_SERVER['SERVER_NAME']);

if ($hostName == 'localhost' || $hostName == '127.0.0.1'){
	define('ENVIRONMENT', 'dev');
}
else if ($hostName == 'staging.simplevoip.us'){
	define('ENVIRONMENT', 'staging');
}
else if ($hostName == 'orders.simplevoip.us' || $hostName == 'activation.simplevoip.us' || $hostName == 'config.simplevoip.us'){
	define('ENVIRONMENT', 'prod');
}
else{  //Default is always for production
	define('ENVIRONMENT', 'prod');
}

//Define the DB settings according to the environment
if (ENVIRONMENT == 'dev') {
	define('WEB_HOST', 		'localhost:8888/Josh/sv_portal');
	define('DB_HOST', 		'localhost:8889');
	define('DB_USER', 		'simplevoip');
	define('DB_PASSWORD', 	'rootroot');
	define('DB_NAME', 		'simplevoip');
}
else if (ENVIRONMENT == 'staging') {
	define('WEB_HOST', 		'staging.simplevoip.us');
	define('DB_HOST', 		'staging.simplevoip.us');
	define('DB_USER', 		'simplevoip');
	define('DB_PASSWORD', 	'rootroot');
	define('DB_NAME', 		'simplevoip');
}
else if (ENVIRONMENT == 'prod') {
	define('WEB_HOST', 		'orders.simplevoip.us');
	define('DB_HOST', 		'sv-mysql.cilqdskq1dv5.us-east-1.rds.amazonaws.com');
	define('DB_USER', 		'simplevoip');
	define('DB_PASSWORD', 	'1Bigpimp!');
	define('DB_NAME', 		'simplevoip');
}

//Customer Database Credentials

define('CUST_SLC_DB_HOST', 		'sv-mysql.cilqdskq1dv5.us-east-1.rds.amazonaws.com');
define('CUST_SLC_DB_USER', 		'selectcomfort');
define('CUST_SLC_DB_PASSWORD', 	'sl33p');
define('CUST_SLC_DB_NAME', 		'sv_customerdata');
?>