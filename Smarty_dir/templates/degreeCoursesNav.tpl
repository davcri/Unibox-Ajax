
<div id="mainContent" class="mainContent">
	<br>

	<p>Seleziona un corso di laurea</p>
	
	<div class="list-group">
	{foreach $degreeCourses as $deg}
		{*<a href="index.php?controllerAction=navigation&degreeCourse={$deg->getName()|escape:'url'}" class="list-group-item">{$deg->getName()}</a>*}
		<a href="index.php?controllerAction=navigation&degreeCourse={$deg->getName()}" class="list-group-item">{$deg->getName()}<span class="badge">#</span></a>
	{/foreach}
	</div>
</div>

<script src="Smarty_dir/templates/javascript/degreeCoursesNav.js"></script>
