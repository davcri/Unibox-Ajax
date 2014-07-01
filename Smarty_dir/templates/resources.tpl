
{function name=displayResourceOLD}
	<h3>{$res->getName()}</h3>
	<div id={$res->getId()}>
		<a href="{$res->getPath()}">Download link {$res->getName()}</a>
		<p> Difficoltà risorsa : {$res->getDifficultyScore()}</p> 
		<p> Qualità risorsa : {$res->getQualityScore()}</p>

		{if $loggedIn}
		{if !$res->hasBeenRated($username)}
			<button class="jqButton"> Vota questa risorsa </button>
			<div class="hidden">				  			
				Difficoltà<div class="slider" id="sliderD{$res->getId()}"></div>
	    		Qualità <div class="slider" id="sliderQ{$res->getId()}"></div> 	
	    		<br>	
	    		<button class="jqButton ajaxVote">Invia voto</button>
	  		</div>
	  	{else}
	  	<p> Hai già votato questa risorsa </p>
	  	{/if}
	  	{/if}			  		
	</div>
{/function}

{function name=displayResource}
	<tr>
		<td><a href="{$res->getPath()}">{$res->getName()}</a></td>
		<td>{$res->getQualityScore()}</td>
		<td>{$res->getDifficultyScore()}</td>
		<td>{$res->getType()}</td>
		<td>{$res->getUploaderUsername()}</td>
		<td>{$res->getDownloadsNumber()}</td>
	</tr>				   
{/function}

<div id="mainContent" class="mainContent">
	<br>
	<ol id="pathBar" class="breadcrumb">
		<li><a href="index.php?controllerAction=navigation"> Risorse</a></li>
		<li><a href="index.php?controllerAction=navigation&degreeCourse={$degreeCourse}">{$degreeCourse}</a></li>
		<li>{$subject_name}</li>
	</ol>

	<h3>{$subject_name}</h3>
	<h3>Teoria</h3>
	<table class="table">
		<tr>
			<th>Nome</th> <th>Qualità</th> <th>Difficoltà</th> <th>Tipo</th> <th>Uploader</th> <th># Downloads</th>
			{foreach $resource as $res}
				{if $res->getCategory()=='teoria'}
					{displayResource}					
				{/if}				
			{/foreach}
		</tr> 
	</table>
					

	<h3>Esercizi</h3>
	<table class="table">
	<tr>
		<th>Nome</th> <th>Qualità</th> <th>Difficoltà</th> <th>Tipo</th> <th>Uploader</th> <th># Downloads</th>
		{foreach $resource as $res}
			{if $res->getcategory()=='esercizi'}
				{displayResource}		
			{/if}

		{/foreach}
		</tr>
	</table>

	<h3>Laboratorio</h3>	
	<table class="table">
		<tr>
			<th>Nome</th> <th>Qualità</th> <th>Difficoltà</th> <th>Tipo</th> <th>Uploader</th> <th># Downloads</th>
		{foreach $resource as $res}	
			{if $res->getCategory()=='laboratorio'}
				{displayResource}		
			{/if}
		{/foreach}
		</tr>
	</table>
		
</div>

<script src="Smarty_dir/templates/javascript/resources.js"></script> 
<!-- <link rel="stylesheet" href="Library/jquery-ui/css/custom-theme/jquery-ui-1.10.4.custom.css">
-->