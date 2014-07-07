
{function name=displayResource}
	<tr>
		<td><a href="index.php?controllerAction=resource&degreeCourse={$degreeCourse}&resourceId={$res->getId()}">{$res->getName()}</a></td>
		<td>{$res->getCategory()}</td>
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
		
		<table id="tableS" class="tablesorter">
			<thead>
			<tr>
				<th>Nome</th> <th>Categoria</th> <th>Qualità</th> <th>Difficoltà</th> <th>Tipo</th> <th>Uploader</th> <th># Downloads</th>
			</tr>
			</thead>
			<tbody>
				{foreach $resource as $res}
					
						{displayResource}					
									
				{/foreach}
			</tbody>
		</table>						

		<!-- <h3>Esercizi</h3>
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
		</table> -->		
	</div>
</div>



<link rel="stylesheet" href="Library/tablesorter-master/css/theme.metro-dark.css">
<script src="Library/tablesorter-master/js/jquery.tablesorter.js"></script>
<script src="Smarty_dir/templates/javascript/resources.js"></script> 

<!-- <link rel="stylesheet" href="Library/jquery-ui/css/custom-theme/jquery-ui-1.10.4.custom.css">
-->