
{function name=displayResource}
	<tr>
		<td><a href="index.php?controllerAction=resource&resourceAction=getResourcePage&degreeCourse={$degreeCourse}&resourceId={$res->getId()}">{$res->getName()}</a></td>
		<td>{$res->getCategory()}</td>
		<td>{$res->getQualityScore()}</td>
		<td>{$res->getDifficultyScore()}</td>
		<td>{$res->getType()}</td>
		<td>{$res->getUploaderUsername()}</td>
		<td>{$res->getDownloadsNumber()}</td>
		<td><div id="linkUser"><a href="index.php?controllerAction=profile&profileAction=getProfilePage&userProfile={$res->getUploaderUsername()}">{$res->getUploaderUsername()}</a></div></td>
	</tr>				   
{/function}

<ol id="pathBar" class="breadcrumb">
	<li><span class="glyphicon glyphicon-folder-open"></span></li>
	<li><a href="index.php?controllerAction=navigation"> Risorse</a></li>
	<li><a href="index.php?controllerAction=navigation&degreeCourse={$degreeCourse}">{$degreeCourse}</a></li>
	<li>{$subject_name}</li>
</ol>

<div id="mainContent" class="mainContent">
	<br>
	<div id="resourcesContainer">
		<h3>{$subject_name}</h3> <br>
		
		<table id="tableS" class="tablesorter">
			<thead>
			<tr>
				<th>Nome</th> <th>Categoria</th> <th>Qualità</th> <th>Difficoltà</th> <th>Tipo</th> <th>Uploader</th> <th># Downloads</th><th>username</th>
			</tr>
			</thead>
			<tbody>
				{foreach $resource as $res}
					
						{displayResource}					
									
				{/foreach}
			</tbody>
		</table>	
		
		<div id="tablePager" class="pager">
			<form>
				<img src="Library/tablesorter-master/addons/pager/icons/first.png" class="first"/>
				<img src="Library/tablesorter-master/addons/pager/icons/prev.png" class="prev"/>
				<span class="pagedisplay"></span> <!-- this can be any element, including an input -->	
				<img src="Library/tablesorter-master/addons/pager/icons/next.png" class="next"/>
				<img src="Library/tablesorter-master/addons/pager/icons/last.png" class="last"/>
				<select class="pagesize">
				  <option selected="selected" value="10">10</option>
				  <option value="4">4</option>
				  <option value="30">30</option>
				  <option value="40">40</option>
				</select>
			</form>
		</div>					

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
<link rel="stylesheet" href="Library/tablesorter-master/addons/pager/jquery.tablesorter.pager.css">

<script src="Library/tablesorter-master/js/jquery.tablesorter.js"></script>
<script src="Library/tablesorter-master/js/jquery.tablesorter.widgets.min.js"></script>
<script src="Library/tablesorter-master/addons/pager/jquery.tablesorter.pager.min.js"></script>
<script src="Smarty_dir/templates/javascript/resources.js"></script> 

<!-- <link rel="stylesheet" href="Library/jquery-ui/css/custom-theme/jquery-ui-1.10.4.custom.css">
-->