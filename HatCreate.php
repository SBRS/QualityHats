<?php
$mysqli = new mysqli("localhost", "lia15", "06121987", "lia15mysql3");
if ($mysqli->connect_errno)
{
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
$sql="SELECT * FROM category";
	  
$rs=$mysqli->query($sql);
if (!$rs)
{
	exit("Error in SQL Category");
}

$sqlSupplier="SELECT * FROM supplier";
	  
$result=$mysqli->query($sqlSupplier);
if (!$result)
{
	exit("Error in SQL Supplier");
}
?>

<link rel="stylesheet" href="css/site.css" />
<link href="https://fonts.googleapis.com/css?family=Racing+Sans+One" rel="stylesheet">

<h2 class="title">Create A New Hat</h2>

<form method="post" enctype="multipart/form-data" onsubmit="return onHatCreate()" action="index.php?content_page=Hats&action=create">
    <div class="form-horizontal">
        <h4 class="title">Please enter details</h4>
        <hr />
        <div class="form-group">
            <label class="col-md-2 control-label">Hat Name</label>
            <div class="col-md-3">
                <input class="form-control" type="text" name="hat_name"/>
                <span id="errorHatName" class="text-danger"></span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Description</label>
            <div class="col-md-3">
                <textarea class="form-control" name="hat_description"></textarea>
                <span id="errorHatDescription" class="text-danger"></span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Price</label>
            <div class="col-md-3">
                <input class="form-control" type="text" name="hat_price"/>
                <span id="errorHatPrice" class="text-danger"></span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Category</label>
            <div class="col-md-3">
                <select class ="form-control" name="category_option"/>
                	<?php
					while ($row = $rs->fetch_assoc())
					{
						echo "<option value='".$row['CategoryId']."'>".$row['CategoryName']."</option>";
					}
					?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Supplier</label>
            <div class="col-md-3">
                <select class ="form-control" name="supplier_option"/>
                	<?php
					while ($rowSupplier = $result->fetch_assoc())
					{
						echo "<option value='".$rowSupplier['SupplierId']."'>".$rowSupplier['SupplierName']."</option>";
					}
					?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-offset-1">
                <input type="file" name="hat_image"/>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-offset-2 col-md-3">
                <input type="submit" value="Create" class="btn btn-default" />
            </div>
        </div>
    </div>
</form>

<form method="post" enctype="multipart/form-data" action="index.php?content_page=Hats">
<input type="Submit" value="Back to List" class="btn btn-warning"/>
</form>

<hr />