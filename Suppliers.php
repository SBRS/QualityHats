<form method="post" enctype="multipart/form-data" action="index.php?content_page=SupplierCreate">
<input type="Submit" value="Create New" class="btn btn-success"/>
</form>
<br>
<?php
// create connection
$mysqli = new mysqli("localhost", "lia15", "06121987", "lia15mysql3");
if ($mysqli->connect_errno)
{
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

if (isset($_GET['action']) && $_GET['action']=='create')
{	
	$supplier_name = $_POST['SupplierName'];	
	$email = $_POST['Email'];
	$home_number = $_POST['HomeNumber'];
	$mobile_number = $_POST['MobileNumber'];
	$work_number = $_POST['WorkNumber'];
	
	if(!($stmt = $mysqli->prepare("INSERT INTO supplier (SupplierName, Email, HomeNumber, MobileNumber, PhoneNumber) VALUES (?,?,?,?,?)")))
	{
		echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}

	if(!$stmt->bind_param("sssss", $supplier_name, $email, $home_number, $mobile_number, $work_number))
	{
		echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
	}
	
	if(!$stmt->execute())
	{
		echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
	}

    $stmt->close();
}

$sql="SELECT * FROM supplier";
	  
$rs=$mysqli->query($sql);
if (!$rs)
{
	exit("Error in SQL");
}
?>

<table class="table">
	<tr>
    	<th>Supplier</th>
    	<th>Email</th>
    	<th>Home</th>
    	<th>Mobile</th>
    	<th>Work</th>
    </tr>

<?php  
while ($row = $rs->fetch_assoc())
{
	echo "<tr>";
	echo "<td>".$row['SupplierId']."</td>";
	echo "<td>".$row['Email']."</td>";
	echo "<td>".$row['HomeNumber']."</td>";
	echo "<td>".$row['MobileNumber']."</td>";
	echo "<td>".$row['WorkNumber']."</td>";;
	echo "</tr>";
}
?>
</table>
<hr/>