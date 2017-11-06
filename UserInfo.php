<?php
session_start();
$user = $_SESSION['current_user'];
// create connection
$mysqli = new mysqli("localhost", "lia15", "06121987", "lia15mysql3");
if ($mysqli->connect_errno)
{
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$sql='SELECT * FROM user WHERE Email = "'.$user.'"';
	  
$rs=$mysqli->query($sql);
if (!$rs)
{
	exit("Error in SQL");
}
$row = $rs->fetch_assoc();
extract($row);
?>

<h2 class="title">Your Account</h2>

<div>
    <hr />
    <dl class="dl-horizontal">
        <dt>First Name:</dt>
        <dd><?php echo $FirstName; ?></dd>
        <dt>Last Name:</dt>
		<dd><?php echo $LastName; ?></dd>
       	<dt>Email:</dt>
		<dd><?php echo $Email; ?></dd>
        <dt>Address:</dt>
		<dd><?php echo $Address; ?></dd>
        <dt>Mobile:</dt>
		<dd><?php echo $MobileNumber; ?></dd>
        <dt>Home:</dt>
		<dd><?php echo $HomeNumber; ?></dd>
        <dt>Work:</dt>
		<dd><?php echo $WorkNumber; ?></dd>
    </dl>
</div>
<hr/>