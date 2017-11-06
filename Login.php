<?php
   session_start(); //starting session
	
   // include username and password array and the function
   require("UserDetails.php");
    
	// if the user has input username and password
	if (isset($_POST['form_username']) and isset($_POST['form_password']))
    {			
		//The login is not successful, set the login flag to false
	        $_SESSION['flag'] = false;
			
			// call the pre-defined function and check if user is authenticated
			if (checkUserCredentals($_POST['form_username'], $_POST['form_password']))
			{
				if ($_SESSION['enabled'] == '1')
				{
					//The login is successful, set the login flag to true and save the current user name
					$_SESSION['flag'] = true;
					$_SESSION['current_user'] = $_POST['form_username'];

					//redirect the user to the correct page
					//find out where to go after login
					if (isset($_SESSION['request_page']))
					$redirect_page = "http://dochyper.unitec.ac.nz/lia15/PHPAssignment/index.php?content_page=".$_SESSION['request_page'];
					else
					$redirect_page = "http://dochyper.unitec.ac.nz/lia15/PHPAssignment/index.php";

					//redirect the user to the correct page after login
					header("Location: ".$redirect_page);
				}
				else
				{
					$info = 'Your Account is currently Disabled, please consult the Administrator.';
				}
			}
	} //Otherwise, stay in the login page
	
?>
<h2 class="title">Log in</h2>
<div class="row">
    <div class="col-md-8">
        <section>
            <form method="post" class="form-horizontal">
                <h4 class="title">Use a local account to log in</h4>
                <hr />
                <div class="text-danger"><p><?php echo $info; ?></p></div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Email</label>
                    <div class="col-md-4">
                        <input class="form-control" type="text" name="form_username" value="<?php if(isset($_POST['form_username'])) echo $_POST['form_username']; ?>"/>
                        <span class="text-danger"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Password</label>
                    <div class="col-md-4">
                        <input class="form-control" type="password" name="form_password"/>
                        <span class="text-danger"></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <button type="submit" class="btn btn-default">Log in</button>
                    </div>
                </div>
                <p>
                    <a runat="server" href="index.php?content_page=Register">Register as a new user?</a>
                </p>
            </form>
        </section>
    </div>
</div>
