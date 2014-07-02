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

	<div id="resourcesContainer">
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
</div>

<script src="Smarty_dir/templates/javascript/resources.js"></script> 
<!-- <link rel="stylesheet" href="Library/jquery-ui/css/custom-theme/jquery-ui-1.10.4.custom.css">
-->