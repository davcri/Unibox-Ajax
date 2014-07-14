
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
	  			<p class="text-center"><a id="ajaxVote" href="index.php?controllerAction=resource&resourceAction=rateResource" class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span> Vota questa risorsa</a></p>
			</div>			  					
	  	</div>
	</div>					   
{/function}

{if !empty($degreeCourse)}
	<ol id="pathBar" class="breadcrumb">
		<li><span class="glyphicon glyphicon-folder-open"></span></li>
		<li><a href="index.php?controllerAction=navigation"> Risorse</a></li>
		<li><a href="index.php?controllerAction=navigation&degreeCourse={$degreeCourse}">{$degreeCourse}</a></li>
		<li><a href="index.php?controllerAction=navigation&degreeCourse={$degreeCourse}&subject={$subject->getCode()}">{$subject->getName()}</a></li>
		<li>{$resource->getName()}</li>
	</ol>
{/if}

<div id="mainContent" class="mainContent">
	<br>
	<div id="resourceContainer" class="row">
		<div class="col-md-8">
			<div class="panel panel-success">
				<div class="panel-heading">
					Descrizione
				</div>

				<div class="panel-body">
					<blockquote>
					  <p><em>{$resource->getDescription()}</em></p>
					</blockquote>
				</div>

				<ul class="list-group">
					<li class="list-group-item">
					Qualità <span id="qualityScore" class="badge">{$resource->getQualityScore()}</span>
					</li>
					<li class="list-group-item">
						Difficoltà <span id="difficultyScore" class="badge">{$resource->getDifficultyScore()}</span> 
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
					  	# Downloads <span id="downloadsCount" class="badge">{$resource->getDownloadsNumber()}</span>
					</li>
					<li class="list-group-item">
					  	Data di caricamento <span class="badge">{$resource->getUploadingDate()->format("d/m/y H:i:s")}</span>
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
					 <div class="alert alert-warning text-center">Hai già votato questa risorsa</div>
				{/if}

			{else}
				<div id="loginRequiredForResourceRating" class="alert alert-danger text-center">Effettua il login per votare questa risorsa</div>
				{displayRatingPanel visibility=false}
			{/if}
		</div>

		<div class="col-md-4">
			{if $resource->getType()=="pdf"}
			<div>
				<object width='100%' height="600" data="{$resource->getPath()}"></object>
			</div>
			{/if}			
		</div>				
	</div>	
</div>

<script src="Smarty_dir/templates/javascript/resourcePage.js"></script> 
<link rel="stylesheet" href="Library/jquery-ui/css/custom-theme/jquery-ui-1.10.4.custom.css">
