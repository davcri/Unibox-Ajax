<div id="mainContent" class="row mainContent">
	<br>
	<p class="lead">Benvenuto su Unibox, un'applicazione per trovare e condivere materiale didattico.</p>

	<!-- <p><button id="moreInfo" class="btn btn-info"><span class="glyphicon glyphicon-plus"></span> Scopri di pi&ugrave</button></p> -->

	<div class="list-group">				
		<div class="list-group-item">
			<h4 class="list-group-item-heading"><span class="glyphicon glyphicon-file"></span> File</h4>
			<p class="list-group-item-text">Documenti, immagini, registrazioni audio per aiutarti nello studio</p>
		</div>

		<div class="list-group-item">
			<h4 class="list-group-item-heading"><span class="glyphicon glyphicon-time"></span> Evita perdite di tempo</h4>
			<p class="list-group-item-text">Con il sistema di rating puoi individuare immediatamente le risorse pi&ugrave utili e adatte alla tua preparazione</p>
		</div>

		<div class="list-group-item">
			<h4 class="list-group-item-heading"><span class="glyphicon glyphicon-upload"></span> Contribuisci</h4>
			<p class="list-group-item-text">Aiutaci a migliorare il sito, caricando i file che ritieni utili oppure votando le risorse caricate dagli altri utenti</p>
		</div>
	</div>

	<br><br>
	<div id="mostActiveUsers" class="col-md-6">
		<div class="panel panel-success">
			<div class="panel-heading">
				<span class="glyphicon glyphicon-user"></span> Utenti pi&ugrave attivi
			</div>	

			<div class="panel-body">
				<table class="table"> 
					<thead>
						<th>
							#
						</th>
						<th>
							Username
						</th>	
					</thead>
					<tbody>
						{if count($greatestUsers)==0}
							<tr>
								<td>
									Non &egrave stata trovata attivit&agrave da parte di alcun utente
								</td>
							</tr>	
						{else}
							{foreach $greatestUsers as $user}
								<tr>
									<td>
										{$user@iteration}
									</td>
									<td>
										<a href="index.php?controllerAction=profile&profileAction=getProfilePage&userProfile={$user->getUsername()}"> {$user->getUsername()}</a> <br>
									</td>
								</tr>	
							{/foreach}					
						{/if}
					</tbody>				
				</table>				
			</div>
		</div>
	</div>

	<div id="mostDownloadedResources" class="col-md-6">
		<div class="panel panel-success">
			<div class="panel-heading">
				<span class="glyphicon glyphicon-book"></span> Risorse pi&ugrave scaricate
			</div>

			<div class="panel-body">
				<table class="table"> 
					<thead>
						<th>
							#
						</th>
						<th>
							Risorsa
						</th>
						<th>
							Downloads
						</th>		
					</thead>
					<tbody>
					{if count($greatestResources)==0}
						<tr>
							<td>
								Non &egrave stata trovata attivit&agrave da parte di alcun utente
							</td>
						</tr>	
					{else}
						{foreach $greatestResources as $resource}
							<tr>
								<td>
									{$resource@iteration}
								</td>
								<td>
									<a href="index.php?controllerAction=resource&resourceAction=getResourcePage&resourceId={$resource->getId()}"> {$resource->getName()}</a> <br>
								</td>
								<td>
									{$resource->getDownloadsNumber()}
								</td>
							</tr>	
						{/foreach}					
					{/if}
					</tbody>				
				</table>
			</div>
		</div>
	</div>
	

	<br>
	<div class="col-md-12">
		<br> <br>
		<div class="alert alert-warning" role="alert">
			<span class="glyphicon glyphicon-warning-sign"></span> <b>Attenzione </b><br> Questa applicazione web &egrave ancora in via di sviluppo, se trovi qualche bug o hai qualche suggerimento contattaci. Trovi tutte le informazioni qui sotto, in fondo alla pagina.
		</div>
	</div>	
</div>

<script src="Smarty_dir/templates/javascript/home.js"></script>
