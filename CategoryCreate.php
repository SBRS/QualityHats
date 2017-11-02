<link rel="stylesheet" href="css/site.css" />
<link href="https://fonts.googleapis.com/css?family=Racing+Sans+One" rel="stylesheet">

<h2 class="title">Create A New Category</h2>

<form method="post" enctype="multipart/form-data" action="index.php?content_page=Categories&action=create">
    <div class="form-horizontal">
        <h4 class="title">Please enter details</h4>
        <hr />
        <div class="form-group">
            <label class="col-md-2 control-label">Category</label>
            <div class="col-md-3">
                <input class="form-control" type="text" name="category_name"/>
                <span class="text-danger"></span>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-offset-2 col-md-3">
                <input type="submit" value="Create" class="btn btn-default" />
            </div>
        </div>
    </div>
</form>

<form method="post" enctype="multipart/form-data" action="index.php?content_page=Categories">
<input type="Submit" value="Back to List" class="btn btn-warning"/>
</form>

<hr />