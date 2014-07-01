
<h1> questo il content-default di navigation </h1>

{foreach $content_navigation as $degreeCourse}

	<li> <a href="index.php?controllerAction=navigation&degreeCourse={$degreeCourse->getName()|escape:'url'}"> {$degreeCourse->getName()}</a></li>
{/foreach}
