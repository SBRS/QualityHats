<link rel="stylesheet" href="css/site.css" />
<link href="https://fonts.googleapis.com/css?family=Racing+Sans+One|Righteous" rel="stylesheet">

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
			</ul>
		</div>
	</div>
</div>    

<!-- The body area -->
<div class="container content"><?php include($page_content);?></div> 

<!-- Footer -->
<div align = "center">
&copy;2017 Quality Hats
</div>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
