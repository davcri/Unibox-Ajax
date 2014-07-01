
{function name=displayResource}
	<h3>{$res->getName()}</h3>
	<div id={$res->getId()}>
		<a href="{$res->getPath()}">Download link {$res->getName()}</a>
		<p> Difficoltà risorsa : {$res->getDifficultyScore()}</p> 
		<p> Qualità risorsa : {$res->getQualityScore()}</p>

		{if $loggedin}
		{if !$res->hasBeenRated($user)}
			<button class="jqButton"> Vota questa risorsa </button>
			<div class="hidden">				  			
				Difficoltà<div class="slider" id="sliderD{$res->getId()}"></div>
	    		Qualità <div class="slider" id="sliderQ{$res->getId()}"></div> 	
	    		<br>	
	    		<button class="jqButton ajaxVote">Invia voto</button>
	  		</div>
	  	{else}
	  	<p> Hai già votato questa risorsa </p>
	  	{/if}
	  	{/if}			  		
	</div>
{/function}


<h2>{$subject_name}</h2>
	<h3>Teoria</h3>
		<div class="accordion">
			{foreach $resource as $res}
				{if $res->getCategory()=='teoria'}
					{displayResource}					
				{/if}				
			{/foreach} 
		</div>				
	
	<h3>Esercizi</h3>	
		<div class="accordion">
			{foreach $resource as $res}
				{if $res->getcategory()=='esercizi'}
					{displayResource}		
				{/if}

			{/foreach}
		</div>
	<h3>Laboratorio</h3>
		<div class="accordion">
			{foreach $resource as $res}	
				{if $res->getCategory()=='laboratorio'}
					{displayResource}		
				{/if}
			{/foreach}
		</div>	


<script src="Smarty_dir/templates/javascript/subjectNavigation.js"></script>