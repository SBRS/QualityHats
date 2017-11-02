<?php
// create connection
$mysqli = new mysqli("localhost", "lia15", "06121987", "lia15mysql3");
if ($mysqli->connect_errno)
{
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

if (isset($_GET['action']) && $_GET['action']=='shipped')
{	
	$sql = "UPDATE order_user
			SET Status='Shipped'
			WHERE OrderId='".$_GET['id']."'"; 
	
	if (!$mysqli->query($sql)) {
		echo "SQL operation failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}
}
elseif (isset($_GET['action']) && $_GET['action']=='waiting')
{	
	$sql = "UPDATE order_user
			SET Status='Waiting'
			WHERE OrderId='".$_GET['id']."'"; 
	
	if (!$mysqli->query($sql)) {
		echo "SQL operation failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}
}

$sql="SELECT * FROM order_user, user WHERE user.UserId=order_user.UserId";
	  
$rs=$mysqli->query($sql);
if (!$rs)
{
	exit("Error in SQL");
}
?>

<h2 class="title">Orders</h2>

<table class="table">
	<tr>
		<th>Order Id</th>
   		<th>User</th>
   		<th>Subtotal</th>
   		<th>GST</th>
   		<th>Grand Total</th>    	
    	<th>Order Date</th>
    	<th>Status</th>
    	<th>Change status</th>
    </tr>

<?php  
while ($row = $rs->fetch_assoc())
{
	echo "<tr>";
	echo "<td>".$row['OrderId']."</td>";
	echo "<td>".$row['Email']."</td>";
	echo "<td>".$row['Subtotal']."</td>";
	echo "<td>".$row['GST']."</td>";
	echo "<td>".$row['GrandTotal']."</td>";
	echo "<td>".$row['OrderDate']."</td>";	
	if($row['Status'] == "Waiting")
	{
		echo "<td>Waiting</td>";
		echo "<td><form method='post' enctype='multipart/form-data' action='index.php?														   content_page=Orders&action=shipped&id=".$row['OrderId']."'>
				  <input type='Submit' value='Shipped' class='btn btn-success'/>
			  </form></td>";
	}
	else{
		echo "<td>Shipped</td>";
		echo "<td><form method='post' enctype='multipart/form-data' action='index.php?														   content_page=Orders&action=waiting&id=".$row['OrderId']."'>
		          <input type='Submit' value='Waiting' class='btn btn-warning'/>
	  		  </form></td>";
	}	
	echo "</tr>";
}
?>
</table>
<hr/>