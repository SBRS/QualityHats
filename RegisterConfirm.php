<?php
// create connection
$mysqli = new mysqli("localhost", "lia15", "06121987", "lia15mysql3");
if ($mysqli->connect_errno)
{
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$firstName = $_POST['FirstName'];	
$lastName = $_POST['LastName'];
$email = $_POST['Email'];
$password = $_POST['Password'];
$address = $_POST['Address'];
$mobile = $_POST['MobileNumber'];
$home = $_POST['HomeNumber'];
$work = $_POST['WorkNumber'];
$enabled = '1';

if(!($stmt = $mysqli->prepare("INSERT INTO user (Email,Password,FirstName,LastName,Address,MobileNumber,HomeNumber,WorkNumber,Enabled) VALUES (?,?,?,?,?,?,?,?,?)")))
{
	echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}

// TODO check that $stmt creation succeeded

// "s" means the database expects a string
if(!$stmt->bind_param("sssssssss", $email, $password, $firstName, $lastName, $address, $mobile, $home, $work, $enabled))
{
	echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
}

if(!$stmt->execute())
{
	echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
}

$stmt->close();

$subject = "Quality Hats Registration";

$message = "<h1>Thank you for your registration at Quality Hats!</h1>";
$message .= "<p>Your username: ".$email."</p>";
$message .= "<p>Your password: ".$password."</p>";

$header = "From:qualityhats2017@outlook.com \r\n";
$header .= "Content-type: text/html \r\n";

$retval = mail ($email,$subject,$message,$header);
?>
<h1>Thanks for Registering!</h1>
<p>
    <?php
		if( $retval == true )
		{
			echo "To login, please check your inbox(or spam) for details.";
		}
		else
		{
			echo "Error during registration. Message could not be sent...";
		}
	?>
</p>