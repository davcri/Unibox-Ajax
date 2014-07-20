<div id="profilePage">
	<div id="mainContent" class="mainContent">
		<div class="row">
			<div class="col-md-8">
				<table>
					<tr>
						<th><h4>Username</h4></th>
						<th>&nbsp<span id="userId">{$user->getUsername()}</div></th>
					</tr>
					<tr>
						<th><h4>Nome</h4></th>
						<th>&nbsp{$user->getName()}</th>
					</tr>
					<tr>
						<th><h4>Cognome</h4></th>
						<th>&nbsp{$user->getSurname()}</th>
					</tr>
					<tr>
						<th><h4>E-mail</h4></th>
						<th>&nbsp{$user->getEmail()}</th>
					</tr>
					<tr>
						<th><h4>Corso di laurea</h4></th>
						
						<th>&nbsp{$user->getDegreeCourse()}</th>
					</tr>
				</table>
			</div>
			<div class="col-md-4">
				<div id="votazione">
					<div id="text">{$yourScore}</div>
					{if $wantToVote}
						<div class="hidden" id="votato">{$hasVoted}</div>
					{/if}
					Punteggio :
						{$user->getReliability()}
					<br>
					{for $i=1 to 5}
						{if $user->getReliability()>=$i}
							<span class="glyphicon glyphicon-star" id='{$i}'></span>
						{else}
							<span class="glyphicon glyphicon-star-empty" id='{$i}'></span>
						{/if}
				
					{/for}	

				</div>	
			</div>	
		</div>
		<div class="row">
			<h1>Risorse caricate dall'utente</h1>
			<br>
			<div class="resource">
				<table class="table">
				<thead>
					<th>Nome</th>
					<th>Categoria</th>
					<th>Qualità</th>
					<th>Difficoltà</th>
					<th>Tipo</th>
					<th>#Downloads</th>
				</thead>
				{foreach $resource as $res}
					<tr>
						<td><a href="index.php?controllerAction=resource&resourceAction=getResourcePage&resourceId={$res->getId()}">{$res->getName()}</a></td>
						<td>{$res->getCategory()}</td>
						<td>{$res->getQualityScore()}</td>
						<td>{$res->getDifficultyScore()}</td>
						<td>{$res->getType()}</td>
						<td>{$res->getDownloadsNumber()}</td>
					</tr>		
				{/foreach}
				</table>
			</div>
		</div>
	</div>


</div>
 <script src="Smarty_dir/templates/javascript/profile.js"></script> 
<script src="Smarty_dir/templates/javascript/resourcePage.js"></script>
