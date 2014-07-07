<!DOCTYPE html>
<html>
<head>
	<script src="Library/jquery-ui/js/jquery-1.10.2.js"></script>
	<script src="Library/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
	<script src="Smarty_dir/templates/javascript/mainScript.js"></script>

	<!-- <script src="Library/bootstrap-3.1.1-dist/js/bootstrap.js"></script> -->

	<link href="Smarty_dir/templates/css/style.css" rel="stylesheet" type="text/css">
	<link href="Library/bootstrap-3.1.1-dist/css/bootstrap.css" rel="stylesheet" type="text/css">
</head>

<body>
	<div class="container">
		<div class="page-header">
	  		<h1>Unibox <small> all you need it's me !</small></h1>
		</div>

		<div class="navbar navbar-default">
			<div class="container-fluid">
				
				<!-- To enable responsive mode for smartphone resolutions, uncomment the following lines and include the bootstrap.js library -->
			    <!--<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					
					<a class="navbar-brand"> <span class="glyphicon glyphicon-inbox"></span> </a>
				</div> -->
				

				<!-- <span class="navbar-brand glyphicon glyphicon-inbox"></span> -->
				<span class="glyphicon glyphicon-inbox navbar-brand"></span>
				<!-- <div class="navbar-collapse collapse">  -->
				<ul id="navigationBar" class="nav navbar-nav">
					<li id="home" class="active"><a href="index.php?controllerAction=home">Home</a></li>
					<li id="navigation"><a href="index.php?controllerAction=navigation">Risorse</a></li>
					<li id="upload"><a href="index.php?controllerAction=upload">Upload</a></li>
					{if $loggedIn}
						<li id="profile"><a href="index.php?controllerAction=profile">Profilo</a></li>
					{/if}
				</ul>

				{if !$loggedIn}
					{include 'loginForm.tpl'}
				{else}
					{include 'signedIn.tpl'}
				{/if}
				<!-- </div> -->
			</div>
		</div>

		<div id="mainContainer" class="col-md-12">			
			{include 'home.tpl'}
		</div>
		
	</div>
</body>
</html>
