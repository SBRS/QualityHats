<?php
require("CheckLogin.php");
?>

<form method="post" enctype="multipart/form-data" action="index.php?content_page=HatCreate">
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
	if (isset($_FILES["hat_image"]) && ($_FILES["hat_image"]["error"] > 0))
	{
		echo "Error: " . $_FILES["hat_ image"]["error"] . "<br />";
	}
	elseif (isset($_FILES["hat_image"]))
	{
		move_uploaded_file($_FILES["hat_image"]["tmp_name"], "../PHPAssignment/images/hats/" . $_FILES["hat_image"]["name"]); //Save the image as the supplied name
	}
	
	$hat_name = $_POST['hat_name'];	
	$hat_description = $_POST['hat_description'];
	$hat_price = $_POST['hat_price'];
	$hat_image = $_FILES["hat_image"]["name"];
	$hat_categoryId = $_POST['hat_categoryId'];
	$hat_supplierId = $_POST['hat_supplierId'];
	
	if(!($stmt = $mysqli->prepare("INSERT INTO hat (HatName,Description,UnitPrice,ImagePath,CategoryId,SupplierId) VALUES (?,?,?,?,?,?)")))
	{
		echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}

    // TODO check that $stmt creation succeeded

    // "s" means the database expects a string
    if(!$stmt->bind_param("ssssss", $hat_name, $hat_description, $hat_price, $hat_image, $hat_categoryId, $hat_supplierId))
	{
		echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
	}

    if(!$stmt->execute())
	{
		echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
	}

    $stmt->close();
}

//Select hats information
$sql="SELECT hat.HatId As hat_id,
             hat.HatName As hat_name,
             hat.Description As hat_description,
			 hat.UnitPrice As hat_price,
			 hat.ImagePath As hat_image,
			 hat.CategoryId As hat_categoryId,
			 hat.SupplierId As hat_supplierId
      FROM hat";
	  
$rs=$mysqli->query($sql);
if (!$rs)
{
	exit("Error in SQL");
}
?>

<table class="table"> <!-- Hat information table starts -->
	<tr>
   		<th></th>
    	<th>Name</th>
    	<th>Category</th>
    	<th>Price</th>
    	<th></th>
    </tr>

<?php  
//Display hat information in a table
while ($row = $rs->fetch_assoc())
{
	$hat_id=$row["hat_id"];
	$hat_name=$row["hat_name"];
	$hat_description=$row["hat_description"];
	$hat_price=$row["hat_price"];
	$hat_image=$row["hat_image"];
	$hat_categoryId=$row["hat_categoryId"];
	$hat_supplierId=$row["hat_supplierId"];
	$img_name = $hat_image;
	if (!$hat_image) 
	{
		$img_name = "Default.jpg";
	}

	echo "<tr>";
	echo "<td><img style='width: 250px; height: auto;' src='images/hats/" . $img_name . "' alt='Hat Image'
		onerror='this.onerror=null; this.src = \"images/hats/Error.jpg\"'></td>";
	echo "<td>$hat_name</td>";
	echo "<td>$hat_categoryId</td>";
	echo "<td>$hat_price</td>";
	echo "<td><a href='index.php?content_page=php-shopping/cart&action=add&id=".$hat_id."'>Add to cart</a></li></td>";
	echo "</tr>";
}
?>
</table> <!-- Hat information table ends -->

