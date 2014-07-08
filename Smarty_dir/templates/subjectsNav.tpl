
<div id="mainContent" class="mainContent">
	<br>
	<ol id="pathBar" class="breadcrumb">
		<li><a href="index.php?controllerAction=navigation"> Risorse</a></li>
		<li>{$degreeCourse}</li>
	</ol>
	
	<p class="lead"> Benvenuto nella sezione di {$degreeCourse} </p>
	{foreach $subjects as $subject}
   		<a class="list-group-item" href="index.php?controllerAction=navigation&degreeCourse={$degreeCourse}&subject={$subject->getCode()}">{$subject->getName()}<span class="badge">{$resourceDb->countResourcesBySubject($subject->getCode())}</span></a>
	{/foreach}
</div>

<!-- <div id="sidebar" class="col-md-3">
	<div class="well">
		{foreach $subjects as $subject}
   			<li><a href="index.php?controllerAction=navigation&degreeCourse={$degreeCourse|escape:'url'}&subject={$subject->getCode()}">{$subject->getName()}</a></li>
		 {/foreach}
		</ul>
	</div>
</div> -->

<script src="Smarty_dir/templates/javascript/subjectsNav.js"></script>