<?php
include "../inc_db.php";



$siteNumber = $_REQUEST['To'];
$siteNumber = substr($siteNumber,-10);
$sql = "SELECT * from cust_sc_vm where siteNumber='{$siteNumber}' or phone='{$siteNumber}'";
mysql_select_db($db);
$retval = mysql_query( $sql, $conn );
if(mysql_num_rows($retval) == 0)
{
    //SITE NOT FOUND: Email SV
    $tts = "Sorry, we are having trouble connecting to the voicemail system. Our IT team has been notified.";
    $subject = "SLC VM FAIL";
    $msg = "Number Dialed: {$siteNumber}";
    $msg = wordwrap($msg,70);


    $headers = 'From: noreply@simplevoip.us' . "\r\n" .
        'Reply-To: noreply@simplevoip.us' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    $mailto = "jrobs@simplevoip.us";
    $mail1 = mail($mailto, $subject, $msg, $headers);
}
else {
    $row = mysql_fetch_array($retval, MYSQL_ASSOC);
    $vmforward = $row['vmforward'];
    $vmforward = '+1' . $vmforward;

    $tts = "Please wait while we connect you to the voicemail system.";

}

header('Content-Type: application/xml');
?>

<Response>
    <Say voice="woman"><?php echo $tts ?></Say>
    <Dial>
        <Number><?php echo $vmforward ?></Number>
    </Dial>
</Response>


