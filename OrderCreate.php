<?php
session_start(); //starting session
$user = $_SESSION['current_user'];

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

$userId = $UserId;
$userName = $FirstName." ".$LastName;
$userAddress = $Address;
$date = date('Y-m-d H:i:s');
$subtotal = $_SESSION['subtotal'];
$gst = $_SESSION['subtotal'] * 0.15;
$grandTotal = $subtotal + $gst;
$status = "Waiting";

if(!($stmt = $mysqli->prepare("INSERT INTO order_user (UserId,OrderDate,Subtotal,GST,GrandTotal,Status) VALUES (?,?,?,?,?,?)")))
{
	echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}

if(!$stmt->bind_param("isddds", $userId, $date, $subtotal, $gst, $grandTotal, $status))
{
	echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
}

if(!$stmt->execute())
{
	echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
}

$stmt->close();

$orderId = $mysqli->insert_id;
$cart = $_SESSION['cart'];
$items = explode(',',$cart);
$contents = array();

foreach ($items as $item)
{
	$contents[$item] = (isset($contents[$item])) ? $contents[$item] + 1 : 1;
}

foreach ($contents as $id=>$qty)
{
	$sql = 'SELECT * FROM hat WHERE HatId = '.$id;
	$result = $mysqli->query($sql);
	$row = $result->fetch_assoc();
	extract($row);
	
	if(!($stmt = $mysqli->prepare("INSERT INTO order_detail (HatId,OrderId,Quantity,UnitPrice) VALUES (?,?,?,?)")))
	{
		echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}

	if(!$stmt->bind_param("iiid", $id, $orderId, $qty, $UnitPrice))
	{
		echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
	}

	if(!$stmt->execute())
	{
		echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
	}

	$stmt->close();

}
?>

<h2 class="title"><span class="glyphicon glyphicon-saved"></span>Thank you For Your Purchase!</h2>

<div>
    <h4 class="title">The following order will be dispatched as per the details below.</h4>
    <hr />
    <dl class="dl-horizontal">
        <dt>
            Order Id
        </dt>
        <dd>
            <?php echo $orderId ?>
        </dd>
        <dt>
            Customer Name
        </dt>
        <dd>
            <?php echo $userName ?>
        </dd>
        <dt>
            Email
        </dt>
        <dd>
            <?php echo $user ?>
        </dd>
        <dt>
            Address
        </dt>
        <dd>
            <?php echo $userAddress ?>
        </dd>
        <dt>
            Status
        </dt>
        <dd>
            <?php echo $status ?>
        </dd>
        <dt>
            Order Date
        </dt>
        <dd>
            <?php echo $date ?>
        </dd>
<!--
        <dd>
            <table class="table">
                <tr>
                    <th>Hat</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
                @foreach (var item in Model.OrderDetails)
                {
                    <tr>
                        <td>
                            @Html.DisplayFor(modelItem => item.Hat.HatName)
                        </td>
                        <td>
                            @Html.DisplayFor(modelItem => item.Hat.Description)
                        </td>
                        <td>
                            @Html.DisplayFor(modelItem => item.Quantity)
                        </td>
                        <td>
                            @Html.DisplayFor(modelItem => item.Hat.UnitPrice)
                        </td>
                    </tr>
                }
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <label>Subtotal:</label>
                    </td>
                    <td>
                        @Html.DisplayFor(modelItem => Model.Subtotal)
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <label>GST:</label>
                    </td>
                    <td>
                        @Html.DisplayFor(modelItem => Model.GST)
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <label>Grand Total:</label>
                    </td>
                    <td>
                        @Html.DisplayFor(modelItem => Model.GrandTotal)
                    </td>
                </tr>
            </table>
        </dd>
-->

    </dl>
</div>