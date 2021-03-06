
{function name=displayRatingPanel visibility=true}
	
	<div id="loginRequiredForResourceRating" class="alert alert-danger text-center {if $visibility==true}hidden{/if}">Effettua il login per votare questa risorsa</div>

	<div id="ratingPanel" class="panel panel-info {if $visibility==0}hidden{/if}">
		<div class="panel-heading">Pannello per la votazione</div>
	  	<div class="panel-body">			  		
		  	<div class="col-md-2 center">
		  	</div>
		  	<div class="col-md-8 center">
				<p>Qualità  <span id="qualityVal"></span></p> 
		  		<p><div id="qualitySlider" class="slider"></div></p> <br>	
		  		<p>Difficoltà  <span id="difficultyVal"></span></p>  
		  		<p><div id="difficultySlider" class="slider"></div></p> <br>
	  			<p class="text-center"><a id="ajaxVote" href="index.php?controllerAction=resource&resourceAction=rateResource" class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span> Vota questa risorsa</a></p>
			</div>			  					
	  	</div>
	</div>					   
{/function}

{if !empty($degreeCourse)}
	<ol id="pathBar" class="breadcrumb">
		<li><span class="glyphicon glyphicon-folder-open"></span></li>
		<li><a href="index.php?controllerAction=navigation&navigationAction=chooseDegreeCourse"> Risorse</a></li>
		<li><a href="index.php?controllerAction=navigation&navigationAction=chooseSubject&degreeCourse={$degreeCourse}">{$degreeCourse}</a></li>
		<li><a href="index.php?controllerAction=navigation&navigationAction=showResource&degreeCourse={$degreeCourse}&subject={$subject->getCode()}">{$subject->getName()}</a></li>
		<li>{$resource->getName()}</li>
	</ol>
{/if}

<div id="mainContent" class="mainContent">
	<br>
	<div id="resourceContainer" class="row">
		<div id="resourcePanel" class="{if $resource->getType()=="pdf"}col-md-6{else}col-md-12{/if}">
			<div class="panel panel-success">
				<div class="panel-heading">
					Descrizione
				</div>

				<div class="panel-body">
					<blockquote>
					  <p><em>{$resource->getDescription()}</em></p>
					</blockquote>

					<b>Link alla risorsa : </b> <a href="index.php?controllerAction=resource&resourceAction=getResource_StaticPage&resourceId={$resource->getId()}">Link</a>
					<p>Condividi questo link con i tuoi amici per segnalare questa risorsa. </p>
				</div>

				<ul class="list-group">
					<li class="list-group-item" title="Punteggio qualità in decimi">
					Qualit&agrave <span  id="qualityScore" class="badge">{$resource->getQualityScore()}</span>
					</li>
					<li class="list-group-item" title="Punteggio difficoltà in decimi">
						Difficolt&agrave <span id="difficultyScore" class="badge">{$resource->getDifficultyScore()}</span> 
					</li>
					<li class="list-group-item">
						Tipo <span class="badge">{$resource->getType()}</span>
					</li>
					<li class="list-group-item">
					    Dimensione <span class="badge">{$resource->getSize()} MB</span>
					</li>
					<li class="list-group-item">
					  	# Downloads <span id="downloadsCount" class="badge">{$resource->getDownloadsNumber()}</span>
					</li>
					<li class="list-group-item">
					  	Data di caricamento <span class="badge">{$resource->getUploadingDate()->format("d/m/y H:i:s")}</span>
					</li>
					<li class="list-group-item">
						Username <span class="badge" id="userLink"><a href="index.php?controllerAction=profile&profileAction=getProfilePage&userProfile={$resource->getUploaderUsername()}"> <b>{$resource->getUploaderUsername()}</b></a></span>
					</li>

					<li class="list-group-item">
						<div class="text-center">
							<a id="downloadLink" class="btn btn-success" href="{$resource->getPath()}" download><span class="glyphicon glyphicon-download"></span> Download link</a><br>
							<label>Scarica questa risorsa !</label>	
						</div>
					</li>
				</ul>				
			</div>

			<div class="hidden" id="resourceId">{$resource->getId()}</div>
			{if $loggedIn}
				{if !$resource->hasBeenRated($user->getUsername())}
					{displayRatingPanel visibility=true}
				{else}
					 <div class="alert alert-warning text-center">Hai gi&agrave votato questa risorsa</div>
				{/if}

			{else}
				{displayRatingPanel visibility=false}
			{/if}
		</div>

		<div id="filePreview" class="col-md-6">
			{if $resource->getType()=="pdf"}
				<object width='100%' height="600" data="{$resource->getPath()}"></object>
			{/if}			
		</div>				
	</div>	
</div>

<script src="Smarty_dir/templates/javascript/resourcePage.js"></script> 
<link rel="stylesheet" href="Library/jquery-ui/css/custom-theme/jquery-ui-1.10.4.custom.css">
