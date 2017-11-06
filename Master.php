<?php
ob_start(); //set buffer on
session_start();
$user = $_SESSION['current_user'];
require_once("/php-shopping/business_layer/business.inc.php");
?>
<link rel="stylesheet" href="css/site.css" />
<link href="https://fonts.googleapis.com/css?family=Racing+Sans+One|Righteous" rel="stylesheet">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Navigation bar-->
<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="container">
		<!--Collapse button-->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" runat="server" href="index.php?content_page=Home">Quality Hats</a>
		</div>
		<!--links-->
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li><a runat="server" href="index.php?content_page=Home">Home</a></li>
				<li><a runat="server" href="index.php?content_page=Hats">Hats</a></li>
				<li><a runat="server" href="index.php?content_page=ContactUs">Contact Us</a></li>
				<?php 
				if ($user == "admin@qualityhats.co.nz")
				{
					echo '<li class="dropdown">
						      <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="dropdownMenu1">Administrator Tools<b class="caret"></b></a>
					          <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
						         <li><a class="dropdown-item" runat="server" href="index.php?content_page=Customers">Customers</a></li>
								 <li><a class="dropdown-item" runat="server" href="index.php?content_page=Categories">Categories</a></li>
								 <li><a class="dropdown-item" runat="server" href="index.php?content_page=Suppliers">Suppliers</a></li>
								 <li><a class="dropdown-item" runat="server" href="index.php?content_page=Orders">Orders</a></li>
					    	  </ul>
						  </li>';
				}
				if ($_SESSION['flag'] == true)
				{
					if ($user != "admin@qualityhats.co.nz")
					{
						echo '<li><a runat="server" href="index.php?content_page=OrdersUser">My Orders</a></li>';
					}
					echo '<li><a runat="server" href="index.php?content_page=UserInfo">Hello '.$user.'!</a></li>';
					echo '<li><a runat="server" href="index.php?content_page=Logoff">Log off</a></li>';
				}
				else 
				{
					echo '<li><a runat="server" href="index.php?content_page=Register">Register</a></li>
						  <li><a runat="server" href="index.php?content_page=Login">Log in</a></li>';
				}
				?>

				
			</ul>
		</div>
	</div>
</div>    

<!-- The body area -->
<div class="container content"><?php include($page_content);?></div> 

<?php
if ($user != "admin@qualityhats.co.nz")
{
	echo "<div class='container content'>";
	echo '<h2 class="title"><span class="glyphicon glyphicon glyphicon-shopping-cart"></span> Your Cart</h2>';
	Business::processActions();
	echo Business::showCart();
	echo "</div>";
}
?>

<!-- Footer -->
<div align = "center">
&copy;2017 Quality Hats
</div>

<script src="js/site.js"></script>
   
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
