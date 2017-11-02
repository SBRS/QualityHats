<?php
// create connection
$mysqli = new mysqli("localhost", "lia15", "06121987", "lia15mysql3");
if ($mysqli->connect_errno)
{
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

if (isset($_GET['action']) && $_GET['action']=='enable')
{	
	$sql = "UPDATE user
			SET Enabled='1'
			WHERE UserId='".$_GET['id']."'"; 
	
	if (!$mysqli->query($sql)) {
		echo "SQL operation failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}
}
elseif (isset($_GET['action']) && $_GET['action']=='disable')
{	
	$sql = "UPDATE user
			SET Enabled='0'
			WHERE UserId='".$_GET['id']."'"; 
	
	if (!$mysqli->query($sql)) {
		echo "SQL operation failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}
}

$sql="SELECT * FROM user";
	  
$rs=$mysqli->query($sql);
if (!$rs)
{
	exit("Error in SQL");
}
?>

<h2 class="title">Customers</h2>

<table class="table">
	<tr>
		<th>User Id</th>
   		<th>Email</th>
   		<th>First Name</th>
   		<th>Last Name</th>
   		<th>Address</th>
    	<th>Mobile</th>
    	<th>Home</th>
    	<th>Work</th>
    	<th>Enabled</th>
    	<th></th>
    </tr>

<?php  
while ($row = $rs->fetch_assoc())
{
	echo "<tr>";
	echo "<td>".$row['UserId']."</td>";
	echo "<td>".$row['Email']."</td>";
	echo "<td>".$row['FirstName']."</td>";
	echo "<td>".$row['LastName']."</td>";
	echo "<td>".$row['Address']."</td>";
	echo "<td>".$row['MobileNumber']."</td>";
	echo "<td>".$row['HomeNumber']."</td>";
	echo "<td>".$row['WorkNumber']."</td>";
	if($row['Enabled'] == "1")
	{
		echo "<td>Enabled</td>";
		echo "<td><form method='post' enctype='multipart/form-data' action='index.php?														   content_page=Customers&action=disable&id=".$row['UserId']."'>
				  <input type='Submit' value='Disable' class='btn btn-danger'/>
			  </form></td>";
	}
	else{
		echo "<td>Disabled</td>";
		echo "<td><form method='post' enctype='multipart/form-data' action='index.php?														   content_page=Customers&action=enable&id=".$row['UserId']."'>
		          <input type='Submit' value='Enable' class='btn btn-success'/>
	  		  </form></td>";
	}	
	echo "</tr>";
}
?>
</table>
<hr/>