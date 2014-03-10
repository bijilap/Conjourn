<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css">
<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
</head>
<body>

<?php
	//Create connection

	global $con;
	$con=mysqli_connect("localhost","root","","CONJOURN");

	//Check connection
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
 
	function getFriends($con, $emailList, $lat, $long, $email)
	{
		$result1 = mysqli_query($con,"SELECT accountid, authtoken from api_keys where email='$email'");
		$row1 = mysqli_fetch_array($result1);
		
		
		$result = mysqli_query($con,"SELECT a.dispname, a.phno, a.ploclat, a.ploclong FROM profiles a where email in $emailList");
	
		while($row = mysqli_fetch_array($result))
		{	
			$val=getDistance($lat, $long, $row['ploclat'], $row['ploclong']);
			//echo $val.'<br>';
			if($val<160) 
			{
				echo "<li align=\"center\"><table><tr><td> <a href=\"new\">".$row['dispname']."</a></td><td><a href=\"messagetext.php?dispname=".$row['dispname']."&phno=".$row['phno']."&accountid=".$row1['accountid']."&authtoken=".$row1['authtoken']."\" data-role=\"button\" data-icon=\"delete\">MSG</a></td></tr></table></li>";
			}
		}
	}
 
	function getDistance( $lat1, $long1, $lat2, $long2)
	{
		//echo  $lat1.' '.$long1.' '.$lat2.' '.$long2.'<br>';
		$R = 6371; // Earth's Radius
		$dLat = ($lat2-$lat1) * (3.142/180);  
		$dLon = ($long2-$long1) * (3.142/180); 
	
		$a = (sin($dLat/2) * sin($dLat/2)) +
		cos(($lat1)* (3.142/180)) * cos(($lat2)* (3.142/180)) * 
		sin($dLon/2) * sin($dLon/2); 
	
		$c = 2 * atan2(sqrt($a), sqrt(1-$a));
	
		$d = $R * $c; 
		return $d;
	} 
?>
	<div data-role="page">
	<div data-role="header">
		<a href="index.html" rel="external" data-role="button" data-icon="home">Home</a></td>
		<h1>Nearby Contacts</h1>
	</div>

	<div data-role="content">
	<ul id="contacts" data-role="listview" data-inset="false" align="center">
		<?php
		//$email=$_GET['email'];
		$email='bijilap@gmail.com';
		$longitude=$_GET['longitude'];
		$latitude=$_GET['latitude'];
		//$result = mysqli_query($con,"SELECT contact_list FROM contacts where emailid=$email");
$result = mysqli_query($con,"SELECT contact_list FROM contacts where emailid='$email'");
		while($row = mysqli_fetch_array($result))
  		{
			//echo $row['contact_list'];
			echo getFriends($con, $row['contact_list'], $latitude, $longitude, $email);
		}
		
		?>
	</ul>
	</div>
	<?php
		mysqli_close($con)
	?>
	<div data-role="footer" data-position="fixed">
		<h3>Copyright@EasyTravel.org</h3>
	</div>
</body>
</html>
