<?php
ob_start(); //set buffer on
session_start(); //starting session

// Include functions
require_once("/php-shopping/business_layer/business.inc.php");
// Process actions for this page
Business::processActions();
?>

<h2 class="title">Your Shopping Cart</h2>

<?php
echo Business::writeShoppingCart();
?>

<h2 class="title">Please check quantities...</h2>

<?php
echo Business::showCart();
?>

<form method="post" enctype="multipart/form-data" action="index.php?content_page=Hats">
<input type="Submit" value="Back to List" class="btn btn-warning"/>
</form>

<?php
$cart = $_SESSION['cart'];

if($cart)
{
	echo "<form method='post' enctype='multipart/form-data' action='index.php?content_page=OrderCreate'>
			<input type='Submit' value='Create Order' class='btn btn-success'/>
		  </form>";
}
?>