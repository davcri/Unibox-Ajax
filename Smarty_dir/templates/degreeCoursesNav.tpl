
<ol id="pathBar" class="breadcrumb">
	<li><span class="glyphicon glyphicon-folder-open"></span></li>
	<li>Risorse</li>
</ol>

<div id="mainContent" class="mainContent">
	<br>

	<p>Seleziona un corso di laurea</p>
	
	<div class="list-group">
	{foreach $degreeCourses as $deg}
		{$name = $deg->getName()}
		{$count = $resourceDb->countResourcesByDegreeCourse($name)}
		<a href="index.php?controllerAction=navigation&degreeCourse={$deg->getName()}" class="list-group-item">{$name}
		<span class="badge" title="{$count} risorse trovate in {$name}">{$count}</span></a>
	{/foreach}
	</div>
</div>

<script src="Smarty_dir/templates/javascript/degreeCoursesNav.js"></script>
