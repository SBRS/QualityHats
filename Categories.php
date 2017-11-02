<form method="post" enctype="multipart/form-data" action="index.php?content_page=CategoryCreate">
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
	$category_name = $_POST['category_name'];	
	
	if(!($stmt = $mysqli->prepare("INSERT INTO category (CategoryName) VALUES (?)")))
	{
		echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}

    // TODO check that $stmt creation succeeded

    // "s" means the database expects a string
	if(!$stmt->bind_param("s", $category_name))
	{
		echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
	}
	
	if(!$stmt->execute())
	{
		echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
	}

    $stmt->close();
}

$sql="SELECT category.CategoryName As category_name
      FROM category";
	  
$rs=$mysqli->query($sql);
if (!$rs)
{
	exit("Error in SQL");
}
?>

<table class="table"> <!-- Category information table starts -->
	<tr>
    	<th>Category</th>
    	<th></th>
    </tr>

<?php  
//Display category information in a table
while ($row = $rs->fetch_assoc())
{
	$category_name=$row["category_name"];

	echo "<tr>";
	echo "<td>$category_name</td>";
	echo "</tr>";
}
?>
</table> <!-- Category information table ends -->

