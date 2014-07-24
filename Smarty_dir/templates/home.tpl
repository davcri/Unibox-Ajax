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

	<div id="mostActiveUsers" class="col-md-12">
		<p> Gli utenti pi&ugrave attivi sul sito sono : </p>
		{foreach $greatestUsers as $user}
			<a href="index.php?controllerAction=profile&profileAction=getProfilePage&userProfile={$user->getUsername()}"> {$user->getName()}</a> <br> 			
		{/foreach}
		
	<br> <br> <br>
	</div>

	<div class="col-md-12">
		<br>
		<div class="alert alert-warning" role="alert">
			Questa applicazione web &egrave ancora in via di sviluppo, se trovi qualche bug o hai qualche suggerimento contattaci. Trovi tutte le informazioni qui sotto, in fondo alla pagina.
		</div>

	</div>
</div>

<script src="Smarty_dir/templates/javascript/home.js"></script>
