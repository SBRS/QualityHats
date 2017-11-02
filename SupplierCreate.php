<h2 class="title">Create a supplier</h2>

<form method="post" class="form-horizontal" action="index.php?content_page=Suppliers&action=create">
    <h4 class="title">Supplier</h4>
    <hr />
    <div class="text-danger"></div>
    <div class="form-group">
        <label class="col-md-2 control-label">Supplier</label>
        <div class="col-md-4">
            <input class="form-control" name="SupplierName"/>
            <span class="text-danger"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Email</label>
        <div class="col-md-4">
            <input class="form-control" name="Email"/>
            <span class="text-danger"></span>
        </div>
    </div>
	<div class="form-group">
	<label class="col-md-2 control-label">Home</label>
	<div class="col-md-4">
		<input class="form-control" name="HomeNumber"/>
		<span class="text-danger"></span>
	</div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Mobile</label>
        <div class="col-md-4">
            <input class="form-control" name="MobileNumber"/>
            <span class="text-danger"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Work</label>
        <div class="col-md-4">
            <input class="form-control" name="WorkNumber"/>
            <span class="text-danger"></span>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-offset-2 col-md-10">
            <button type="submit" class="btn btn-default">Create</button>
        </div>
    </div>
</form>