<?php
require("ErrorFunctions.php");
//Sets a user function (error_handler) to handle errors in a script
$error_handler = set_error_handler("userErrorHandler");

session_start();
$_SESSION['request_page'] = "Hats";
$user = $_SESSION['current_user'];
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
		echo '<div class="text-warning"><h3>Warning: No image found while creating a hat</h3></div>';
		trigger_error("No file supplied", E_USER_ERROR);
	}
	elseif (isset($_FILES["hat_image"]))
	{
		move_uploaded_file($_FILES["hat_image"]["tmp_name"], "../PHPAssignment/images/hats/" . $_FILES["hat_image"]["name"]); //Save the image as the supplied name
	}
	
	$hat_name = $_POST['hat_name'];	
	$hat_description = $_POST['hat_description'];
	$hat_price = $_POST['hat_price'];
	$hat_image = $_FILES["hat_image"]["name"];
	$hat_categoryId = $_POST['category_option'];
	$hat_supplierId = $_POST['supplier_option'];
	
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

if ($user == "admin@qualityhats.co.nz")
{
	echo "<form method='post' enctype='multipart/form-data' action='index.php?content_page=HatCreate'>
		      <input type='Submit' value='Create New' class='btn btn-success'/>
		  </form>
		  <br>";
}

echo "Category:";

$sql="SELECT * FROM category";	  
$rs=$mysqli->query($sql);
if (!$rs)
{
	exit("Error in SQL");
}

while ($row = $rs->fetch_assoc())
{
	echo '<a class="btn btn-danger" href="index.php?content_page=Hats&categoryId='.$row["CategoryId"].'">'.$row["CategoryName"].'</a>';
}

if (isset($_GET['categoryId']))
{
	$sql="SELECT * FROM hat, supplier, category 
		WHERE hat.CategoryId = ".$_GET['categoryId']." AND supplier.SupplierId=hat.SupplierId AND category.CategoryId=hat.CategoryId";
	echo '<h3 class="title"></h3>';
}
else
{
	$sql="SELECT * FROM hat, supplier, category 
		WHERE supplier.SupplierId=hat.SupplierId AND category.CategoryId=hat.CategoryId";
	echo '<h3 class="title">All Hats</h3>';
}	  
$rs=$mysqli->query($sql);
if (!$rs)
{
	exit("Error in SQL");
}
//Count the record number
$counter = $rs->num_rows;

$PageSize=5;
$PageCount=$counter/$PageSize + 1;

//Output page index table
echo "<table>";
echo "<tr>";
for( $i=1; $i <= $PageCount; $i++)
{
	if (isset($_GET['categoryId']))
	{
		echo "<td><a href=index.php?content_page=Hats&pg=$i&categoryId=".$_GET['categoryId']."><button class='btn btn-info'>Page $i</button></a></td>";
	}
	else
	{
		echo "<td><a href=index.php?content_page=Hats&pg=$i><button class='btn btn-info'>Page $i</button></a></td>";
	}
} //end for
echo "</tr></table><br>";
?>

<table class="table">
	<tr>
   		<th></th>
    	<th>Name</th>
    	<th>Category</th>
    	<th>Description</th>
    	<th>Supplier</th>
    	<th>Price</th>
    	<?php if ($user != "admin@qualityhats.co.nz"){ echo "<th></th>";} ?>
    </tr>

<?php  
// Test if this is the first page 
if (isset($_GET['pg']))
{
  // set the parameters for the rest pages 
  $start= ($_GET['pg']-1)*$PageSize + 1;
  $end= $_GET['pg']*$PageSize;
  if( $end > $counter )
	$end = $counter;
}
else
{
  //set the parameters for the first page
  $start= 1;
  $end= $PageSize;
  if( $end > $counter )
	$end = $counter;
}//end if IsSet("$_GET['pg']")

$j = $start - 1;
/* seek to row no. $j */
$rs->data_seek($j);

//Display the page 
for( $i=$start; $i <= $end; $i++)
{
	$row = $rs->fetch_assoc();
	$hat_image=$row['ImagePath'];
	$img_name = $hat_image;
	if (!$hat_image) 
	{
		$img_name = "Default.jpg";
	}

	echo "<tr>";
	echo "<td><img style='width: 250px; height: auto;' src='images/hats/".$img_name."' alt='Hat Image'
		onerror='this.onerror=null; this.src = \"images/hats/Error.jpg\"'></td>";
	echo "<td>".$row['HatName']."</td>";
	echo "<td>".$row['CategoryName']."</td>";
	echo "<td>".$row['Description']."</td>";
	echo "<td>".$row['SupplierName']."</td>";
	echo "<td>".$row['UnitPrice']."</td>";
	if ($user != "admin@qualityhats.co.nz")
	{
		echo "<td><a href='index.php?content_page=Hats&action=add&id=".$row['HatId']."'><button class='btn btn-warning'>Add to cart</button></a></li></td>";
	}
	echo "</tr>";
}
echo "</table>";
	
echo "<table>";
echo "<tr>";
for( $i=1; $i <= $PageCount; $i++)
{
	if (isset($_GET['categoryId']))
	{
		echo "<td><a href=index.php?content_page=Hats&pg=$i&categoryId=".$_GET['categoryId']."><button class='btn btn-info'>Page $i</button></a></td>";
	}
	else
	{
		echo "<td><a href=index.php?content_page=Hats&pg=$i><button class='btn btn-info'>Page $i</button></a></td>";
	}
} //end for
echo "</tr></table><br>";

$rs->free();    
//close connection 
$mysqli->close(); 
?>