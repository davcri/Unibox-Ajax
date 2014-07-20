<!DOCTYPE html>
<html>
<head>
	<link href="Library/bootstrap-3.1.1-dist/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="Smarty_dir/templates/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
	<div class="container">
		<div class="page-header">
	  		<span><img id="img" src="Smarty_dir/templates/img/logoBox2.jpg"></span> <span><div id="nameApp"><h1>Unibox<small> Pagina di installazione</small></h1></div></span>
		</div>

		<div id="mainContainer" class="col-md-12">
			<div class="mainContent row">
				<div class="col-md-6">
					<p class="lead"> Dettagli del server </p>				
					{foreach $serverDetails as $key=>$val}
						{$key} => {$val} <br>
					{/foreach}
				</div>
				
				<div class="col-md-6">
					<p class="lead"> Dettagli del progetto </p>				
					{foreach $projectDetails as $key=>$val}
						{$key} => {$val} <br>
					{/foreach}
				</div>

				<div class="col-md-12">
					<br> <br> 
					<hr>
					<p class="lead"> Configurazione</p>
					<p> Prima di utilizzare questa applicazione web configura le impostazioni di connessione al database : </p>
				</div>

				<form action="index.php?installAction=createConfigFile" method="POST">
					<div class="col-md-4">
						
						<div class="form-group">
					    	<label>User</label>
					    	<input type="text" name="user" class="form-control" placeholder="user del database">
						  	
						</div>
						<div class="form-group">
					    	<label>Password</label>
					    	<input type="text" name="password" class="form-control" placeholder="password">
						  	
						</div>
						<div class="form-group">
					    	<label>host</label>
					    	<input type="text" name="host" class="form-control" placeholder="es: localhost">
						  	
						</div>
						<div class="form-group">
					    	<label>Nome del database</label>
					    	<input type="text" name="databaseName" class="form-control" placeholder="es: Unibox">
						  	
						</div>
						
						{if $allFieldsRequired_Error}
							<div class="alert alert-danger">Riempi tutti i campi prima di inviare la form ! </div>
						{/if}
						
						<input type="submit" value="Submit">
						<!-- <button id="submitButton" type="submit" class="btn btn-success">Invia configurazione</button> -->
					</div>
				</form>
				
			<div>			
		</div>	
		
	</div>
</body>
</html>

