<!DOCTYPE html>
<html>
<head>
	<script src="Library/jquery-ui/js/jquery-1.10.2.js"></script>
	<script src="Library/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
	<script src="Smarty_dir/templates/javascript/mainScript.js"></script>
	

	<!-- <script src="Library/bootstrap-3.1.1-dist/js/bootstrap.js"></script> -->

	<link href="Smarty_dir/templates/css/style.css" rel="stylesheet" type="text/css">
	<link href="Library/bootstrap-3.1.1-dist/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="Library/jquery-ui/css/custom-theme/jquery-ui-1.10.4.custom.min.css" rel="stylesheet" type="text/css">

</head>

<body>
	<div class="container">
		<div class="page-header">
	  		<span><img id="img" src="Smarty_dir/templates/img/logoBox2.jpg"></span> <span><div id="nameApp"><h1>Unibox<small> all you need it's me !</small></h1></div></span>
		</div>
			
		<noscript>
			<div class="alert alert-danger" role="alert"> 
				<p>Nel tuo tuo browser &egrave disabilitato Javascript. 
				Questa applicazione web non pu&ograve funzionare senza Javascript, quindi ti preghiamo di abilitarlo. 
				Qui ci sono tutte le <a href="http://www.enable-javascript.com/it/" target="_blank"> istruzioni su come abilitare JavaScript nel tuo browser</a></p>
			</div>
		</noscript>

		<div id="cookieAlert" class="alert alert-warning hidden" role="alert"> 
			I cookie sono disabilitati. Ti preghiamo di attivarli e ricaricare la pagina per consentire il corretto funzionamento di questa applicazione. Puoi attivare i cookie dalle impostazioni del tuo browser 
		</div>

		<div class="navbar navbar-default">
			<div id="navbarContent" class="container-fluid">
				<span class="glyphicon glyphicon-inbox navbar-brand"></span>

				<ul id="navigationBar" class="nav navbar-nav">
					<li id="home" class="active"><a href="index.php?controllerAction=home">Home</a></li>
					<li id="navigation"><a href="index.php?controllerAction=navigation&navigationAction=chooseDegreeCourse">Risorse</a></li>
					<li id="upload"><a href="index.php?controllerAction=upload&uploadAction=getUploadPage">Upload</a></li>
					{if $loggedIn}
						<li id="profile"><a href="index.php?controllerAction=profile&profileAction=getProfilePage&userProfile={$username}">Profilo</a></li>
					{/if}
				</ul>

				{if !$loggedIn}
					{include 'loginForm.tpl'}
				{else}
					{include 'signedIn.tpl'}
				{/if}
			</div>
		</div>

		<div id="mainContainer" class="col-md-12">			
			{include 'home.tpl'}
		</div>

		
		<div id="footer" class="col-md-12 footer">
			<div class="container-fluid">
				<div class="col-md-4">
					<p class="text-center">Chi siamo</p>

				</div>

				<div class="col-md-4">
					<p class="text-center">About</p>
					 <a href="https://github.com/davcri/Unibox-Ajax">la pagina Github del progetto</a>
				</div>

				<div class="col-md-4">
					<p class="text-center">Copyright</p>
				</div>
			</div>
		</div>

	</div>
</body>
</html>

