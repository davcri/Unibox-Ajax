
<ol id="pathBar" class="breadcrumb">
	<li><span class="glyphicon glyphicon-folder-open"></span></li>
	<li><a href="index.php?controllerAction=navigation&navigationAction=chooseDegreeCourse"> Risorse</a></li>
	<li>{$degreeCourse}</li>
</ol>

<div id="mainContent" class="mainContent">
	<br>
	<p class="lead"> Benvenuto nella sezione di {$degreeCourse} </p>
	{foreach $subjects as $subject}
		{$subjName = $subject->getName()}
		{$subjCode = $subject->getCode()}
		{$subjCount = $resourceDb->countResourcesBySubject($subjCode)}

   		<a class="list-group-item" href="index.php?controllerAction=navigation&navigationAction=showResource&degreeCourse={$degreeCourse}&subject={$subjCode}">{$subjName}
   		<span title="{$subjCount} risorse trovate in {$subjName}" class="badge" >{$subjCount}</span></a>
	{/foreach}
	<br>
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