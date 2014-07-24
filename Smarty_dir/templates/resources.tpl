
{function name=displayResource}
	<tr>
		<td><a href="index.php?controllerAction=resource&resourceAction=getResourcePage&degreeCourse={$degreeCourse}&resourceId={$res->getId()}">{$res->getName()}</a></td>
		<td>{$res->getCategory()}</td>
		
		<td>
			<!-- In this functin, hidden span are used to enable sorting of the table with the tablesorter plugin -->

			{if $res->countQualityVotes()==0}
				<div class="difficultyLabel"> <span class="hidden">0</span> Nessun voto</div> 
			{else}
				<span class="hidden">{$res->getQualityScore()}</span>
				
				{for $i=1 to 5}
					{if $res->getQualityScore() >= $i*2}
						<span class="glyphicon glyphicon-star" id='{$i}'></span>
					{else}
						<span class="glyphicon glyphicon-star-empty" id='{$i}'></span>
					{/if}			
				{/for}	
			{/if}
		</td>
		
		{$difficulty = $res->getDifficultyScore()}
		<td>
			{if $res->countDifficultyVotes()==0}
				<div class="difficultyLabel text-center"> Nessun voto</div>
			{else}
				{if $difficulty>=0 && $difficulty<=3} 
			 		<div class="easyResource difficultyLabel text-center"> <span class="hidden">{$difficulty}</span> Facile </div>
				{elseif $difficulty>=4 && $difficulty<=7}
					<div class="mediumResource difficultyLabel text-center"> <span class="hidden">{$difficulty}</span> Normale </div>
				{elseif $difficulty>=8 && $difficulty<=10}
					<div class="hardResource difficultyLabel text-center"> <span class="hidden">{$difficulty}</span> Difficile </div>
				{/if}
			{/if}
		</td>
		<td>{$res->getType()}</td>
		<td>{$res->getDownloadsNumber()}</td>
		<td><div id="linkUser"><a href="index.php?controllerAction=profile&profileAction=getProfilePage&userProfile={$res->getUploaderUsername()}">{$res->getUploaderUsername()}</a></div></td>
	</tr>				   
{/function}

<ol id="pathBar" class="breadcrumb">
	<li><span class="glyphicon glyphicon-folder-open"></span></li>
	<li><a href="index.php?controllerAction=navigation&navigationAction=chooseDegreeCourse"> Risorse</a></li>
	<li><a href="index.php?controllerAction=navigation&navigationAction=chooseSubject&degreeCourse={$degreeCourse}">{$degreeCourse}</a></li>
	<li>{$subject_name}</li>
</ol>

<div id="mainContent" class="mainContent">
	<br>
	<div id="resourcesContainer" class="row">
		<h3>{$subject_name}</h3> <br>
		
		
		<table id="tableS" class="tablesorter">
			<thead>
			<tr>
				<th>Nome</th> <th>Categoria</th> <th>Qualità</th> <th>Difficoltà</th> <th>Tipo</th> <th># Downloads</th><th>username</th>
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
				  <option value="5">5</option>
				  <option selected="selected" value="10">10</option>
				  <option value="30">30</option>
				  <option value="40">40</option>
				</select>
			</form>
		</div>							
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