<h2 class="title">Register</h2>

<form id="registerForm" method="post" class="form-horizontal" onsubmit="return onClickSubmit()" action="index.php?content_page=RegisterConfirm">
    <h4 class="title">Create a new account</h4>
    <hr />
    <div class="text-danger"></div>
    <div class="form-group">
        <label class="col-md-2 control-label">First Name</label>
        <div class="col-md-4">
            <input class="form-control" name="FirstName"/>
            <span id="errorFirstName" class="text-danger"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Last Name</label>
        <div class="col-md-4">
            <input class="form-control" name="LastName"/>
            <span id="errorLastName" class="text-danger"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Email</label>
        <div class="col-md-4">
            <input class="form-control" name="Email"/>
            <span id="errorEmail" class="text-danger"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Password</label>
        <div class="col-md-4">
            <input class="form-control" type="password" name="Password"/>
            <span id="errorPassword" class="text-danger"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Confirm password</label>
        <div class="col-md-4">
            <input class="form-control" type="password" name="ConfirmPassword"/>
            <span id="errorConfirmPassword" class="text-danger"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Address</label>
        <div class="col-md-4">
            <input class="form-control" name="Address"/>
            <span id="errorAddress" class="text-danger"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Mobile</label>
        <div class="col-md-4">
            <input class="form-control" name="MobileNumber"/>
            <span id="errorMobile" class="text-danger"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Home</label>
        <div class="col-md-4">
            <input class="form-control" name="HomeNumber"/>
            <span id="errorHome" class="text-danger"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Work</label>
        <div class="col-md-4">
            <input class="form-control" name="WorkNumber"/>
            <span id="errorWork" class="text-danger"></span>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-offset-2 col-md-10">
            <button type="submit" class="btn btn-default">Register</button>
        </div>
    </div>
</form>