
<div id="mainContent" class="mainContent">
	<br>

	<p>Seleziona un corso di laurea</p>
	
	<div class="list-group">
	{foreach $degreeCourses as $deg}
		<a href="index.php?controllerAction=navigation&degreeCourse={$deg->getName()}" class="list-group-item">{$deg->getName()}<span class="badge">{$resourceDb->countResourcesByDegreeCourse($deg->getName())}</span></a>
	{/foreach}
	</div>
</div>

<script src="Smarty_dir/templates/javascript/degreeCoursesNav.js"></script>
