<!DOCTYPE html>
<html>
<body>

<h1>Test</h1>

<?php
echo "Testing1";
?>

<?php
// Create connection
$con=mysqli_connect("localhost","root","","easytravel");

// Check connection
  if (mysqli_connect_errno())
  {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
  $result = mysqli_query($con,"SELECT * FROM login_twilio");

  while($row = mysqli_fetch_array($result))
  {
	echo $row['gmailId'] . " " . $row['twilioPhoneNo'];
	echo "<br>";
  }
  
 class Contact
 {
	var $fName;
	var $mName;
	var $lName;
	var $location;
	var $phone;
	
	function Contact($fName,$mName,$lName,$location,$phone)
	{
		$this->fName=$fName;
		$this->mName=$mName;
		$this->lName=$lName;
		$this->location=$location;
		$this->phone=$phone;
	}
	function retFName()
	{
		return $this->fName;
	}
	function retMName()
	{
		return $this->mName;
	}
	function retLName()
	{
		return $this->lName;
	}
	function retLocation()
	{
		return $this->location;
	}
	function retPhone()
	{
		return $this->Phone;
	}
 }
  
 function storeNewUser( $gmailId, $twilioPhoneNo)
 {
	mysqli_query($con,"INSERT INTO login_twilio (gmailId, twilioPhoneNo) 
	VALUES ('$gmailId','$twilioPhoneNo')");

	mysqli_close($con);
 }
 
 function storeLocation( $gmailId, $contact )
 {
	mysqli_query($con,"INSERT INTO contact_details (gmailId, fname, mname, lname, location, phone) VALUES ('$gmailId','$contact->retFName()', '$contact->retMName()', '$contact->retLName()', '$contact->retLocation()', '$contact->retPhone()'");

	mysqli_close($con);	
 }
 
?>


</body>
</html>