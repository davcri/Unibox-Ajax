{function name=displayResource}
	<tr>
		<td>{$resource->getName()}</td>
		<td>{$resource->getQualityScore()}</td>
		<td>{$resource->getDifficultyScore()}</td>
		<td>{$resource->getType()}</td>
		<td>{$resource->getUploaderUsername()}</td>
		<td>{$resource->getDownloadsNumber()}</td>
	</tr>				   
{/function}

<div id="mainContent" class="mainContent">
	<br>
	<ol id="pathBar" class="breadcrumb">
		<li><a href="index.php?controllerAction=navigation"> Risorse</a></li>
		<li><a href="index.php?controllerAction=navigation&degreeCourse={$degreeCourse}">{$degreeCourse}</a></li>
		<li><a href="index.php?controllerAction=navigation&degreeCourse={$degreeCourse}&subject={$subject->getCode()}">{$subject->getName()}</a></li>
		<li>{$resource->getName()}</li>
	</ol>

	<div id="resourcesContainer" class="row">		
		<div class="col-md-8">
			Descrizione 
			*Questa parte è ancora da implementare*
			<!-- todo 
			{*$resource->getDescription()*}) -->
		</div>
		<div class="col-md-4">
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
			</ul>
			
			<a class="btn btn-success" href="{$resource->getPath()}" download><span class="glyphicon glyphicon-download"></span> Download</a>
			<label>Scarica questa risorsa !</label> <br><br>
			<th>
			<p>Qualità</p><div class="slider"></div><br>	
			<span>Difficoltà</span><div class="slider"></div>	
		</div>				
	</div>	
</div>

<script src="Smarty_dir/templates/javascript/resourcePage.js"></script> 
<link rel="stylesheet" href="Library/jquery-ui/css/custom-theme/jquery-ui-1.10.4.custom.css">
