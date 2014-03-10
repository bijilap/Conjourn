<?php
require "Services/Twilio.php";

/* Set our AccountSid and AuthToken */
$AccountSid = "AC039eede063a62ee1210452cfd115329b";
$AuthToken = "2a707b93848e765a57cecafaff99e3ab";

/* Your Twilio Number or an Outgoing Caller ID you have previously validated
	with Twilio */
$from= '5103715969';

/* Number you wish to call */
$to= '2132842648';

/* Directory location for callback.php file (for use in REST URL)*/
$url = 'http://www.example.com/clicktocall/';

/* Instantiate a new Twilio Rest Client */
$client = new Services_Twilio($AccountSid, $AuthToken);

if (!isset($_REQUEST['called']) || strlen($_REQUEST['called']) == 0) {
    $err = urlencode("Must specify your phone number");
    header("Location: index.php?msg=$err");
    die;
}

/* make Twilio REST request to initiate outgoing call */
$call = $client->account->calls->create($from, $_REQUEST['called'], $url . 'callback.php?number=' . $_REQUEST['called']);

/* redirect back to the main page with CallSid */
$msg = urlencode("Connecting... ".$call->sid);
header("Location: index.php?msg=$msg");
?>
