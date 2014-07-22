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
				<div class="col-md-12">
					<br> <br> 
					<p class="lead"> Configurazione</p>
					<p> Prima di utilizzare questa applicazione web configura le impostazioni di connessione al database : </p>
				</div>

				<div class="col-md-4">
				<form action="index.php?installAction=createConfigFile" method="POST">
					
						
						<div class="form-group">
					    	<label>User</label>
					    	<input type="text" name="user" class="form-control" placeholder="user del database">
						  	
						</div>
						<div class="form-group">
					    	<label>Password</label>
					    	<input type="password" name="password" class="form-control" placeholder="password">
						  	
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

				
				
				<div class="col-md-12">
					<br> <hr>

					<div class="alert alert-info">
						<p> Di seguito viene riportata una tabella comparativa tra le tecnologie utilizzate in fase di sviluppo di Unibox
						    e quelle trovate sul server su cui si sta installando l'applicazione.</p>
						<p> Se sul server c'&egrave qualche versione molto differente da quelle utilizzate in fase di sviluppo,
						    l'applicazione potrebbe non funzionare correttamente.</p>	
					</div>

					<table class="table">
						<thead>
						<th>
							
						</th>
						{foreach $serverDetails as $key=>$val}
							<th>
								{$key}
							</th>
						{/foreach}
						</thead>
						
						<tbody>
						<tr>
							<td>
								<b>Server</b>
							</td>
							{foreach $serverDetails as $key=>$val}
								<td>
									{$val}	
								</td>
							{/foreach}	
						</tr>
						<tr>
							<td>
								<b>Unibox</b>
							</td>
							{foreach $projectDetails as $key=>$val}
								<td>
									{$val}	
								</td>
							{/foreach}
						</tr>							
						</tbody>
					</table>	
				</div>						
			<div>			
		</div>			
	</div>
</body>
</html>

