
{function name=displayRatingPanel visibility=true}
	<div id="ratingPanel" class="panel panel-warning {if $visibility==0}hidden{/if}">
		<div class="panel-heading">Pannello per la votazione</div>
	  	<div class="panel-body">			  		
		  	<div class="col-md-2 center">
		  	</div>
		  	<div class="col-md-8 center">
				<p>Qualità  <span id="qualityVal"></span></p> 
		  		<p><div id="qualitySlider" class="slider"></div></p> <br>	
		  		<p>Difficoltà  <span id="difficultyVal"></span></p>  
		  		<p><div id="difficultySlider" class="slider"></div></p> <br>
	  			<p class="text-center"><a id="ajaxVote" href="index.php?controllerAction=rateResource" class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span> Vota questa risorsa</a></p>

	  			<div class="hidden" id="resourceId">{$resource->getId()}</div>
			</div>			  					
	  	</div>
	</div>					   
{/function}

<div id="mainContent" class="mainContent">
	<br>
	<ol id="pathBar" class="breadcrumb">
		<li><a href="index.php?controllerAction=navigation"> Risorse</a></li>
		<li><a href="index.php?controllerAction=navigation&degreeCourse={$degreeCourse}">{$degreeCourse}</a></li>
		<li><a href="index.php?controllerAction=navigation&degreeCourse={$degreeCourse}&subject={$subject->getCode()}">{$subject->getName()}</a></li>
		<li>{$resource->getName()}</li>
	</ol>

	<div id="resourceContainer" class="row">		
		<div class="col-md-12">
			<div class="panel panel-success">
				<div class="panel-heading">
					Descrizione
				</div>

				<div class="panel-body">
					<p>Descrizione risorsa *da implementare*<p>
				</div>

				<ul class="list-group">
					<li class="list-group-item">
					Qualità <span class="badge">{$resource->getQualityScore()}</span>
					</li>
					<li class="list-group-item">
						Difficoltà <span class="badge">{$resource->getDifficultyScore()}</span> 
					</li>
					<li class="list-group-item">
						Tipo <span class="badge">{$resource->getType()}</span>
					</li>
					<li class="list-group-item">
					    Dimensione <span class="badge">{$resource->getSize()} MB</span>
					</li>
					<li class="list-group-item">
					  	Uploader <span class="badge">{$resource->getUploaderUsername()}</span>
					</li>
					<li class="list-group-item">
					  	# Downloads <span class="badge">{$resource->getDownloadsNumber()}</span>
					</li>
					<li class="list-group-item">
					  	Data di caricamento <span class="badge">{$resource->getUploadingDate()}</span>
					</li>
					<li class="list-group-item">
						<div class="text-center">
							<a class="btn btn-success" href="{$resource->getPath()}" download><span class="glyphicon glyphicon-download"></span> Download link</a><br>
							<label>Scarica questa risorsa !</label>	
						</div>
					</li>
				</ul>				
			</div>

			{if $loggedIn}
				{if !$resource->hasBeenRated($user->getUsername())}
					{displayRatingPanel visibility=true}
				{else}
					 <div class="alert alert-warning text-center">Hai già votato questa risorsa</div>
				{/if}

			{else}
				<div id="loginRequiredForResourceRating" class="alert alert-danger text-center">Effettua il login per votare questa risorsa</div>
				{displayRatingPanel visibility=false}
			{/if}
			
		</div>				
	</div>	
</div>

<script src="Smarty_dir/templates/javascript/resourcePage.js"></script> 
<link rel="stylesheet" href="Library/jquery-ui/css/custom-theme/jquery-ui-1.10.4.custom.css">
