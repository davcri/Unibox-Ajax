 <h2>Subjects List</h2>
    <ul>

        {foreach $content_navigation_sidebar as $subject}
            <li><a href="index.php?controllerAction=navigation&degreeCourse={$degreeCourse|escape:'url'}&subject={$subject->getCode()}">{$subject->getName()}</a></li>
        
        {/foreach}
    </ul>

            