<html>
<head>
</head>
<body>
<form name="messageform" class="form-inline">
	<p><textarea name="message"class="form-control" rows="4" cols="40"></textarea></p>
</form>
<?php
require "twilio-php-latest/Services/Twilio.php";
$AccountSid = "AC039eede063a62ee1210452cfd115329b";
$AuthToken = "2a707b93848e765a57cecafaff99e3ab";
$client = new Services_Twilio($AccountSid, $AuthToken);
$from = '5103715969';
$to =  $_GET['phno'];
$name = $_GET['dispname'];
//echo "messageform.value";
$body = $_GET['message'];
$client->account->sms_messages->create($from, $to, $body);
echo "Sent message to $name";
?>
</body>
</html>
