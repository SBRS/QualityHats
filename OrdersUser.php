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

$sql='SELECT * FROM order_user WHERE order_user.UserId = "'.$UserId.'"';
	  
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
    	<th>Status</th>
    	<th>Order Date</th>
    </tr>

<?php  
while ($row = $rs->fetch_assoc())
{
	echo "<tr>";
	echo "<td>".$row['OrderId']."</td>";
	echo "<td>".$FirstName." ".$LastName."</td>";
	echo "<td>".$row['Subtotal']."</td>";
	echo "<td>".$row['GST']."</td>";
	echo "<td>".$row['GrandTotal']."</td>";
	echo "<td>".$row['Status']."</td>";	
	echo "<td>".$row['OrderDate']."</td>";		
	echo "</tr>";
}
?>
</table>
<hr/>