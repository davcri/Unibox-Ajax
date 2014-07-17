<div id="profilePage">
	<div id="mainContent" class="mainContent">
		<div class="row">
			<div class="col-md-8">
				<table>
					<tr>
						<th>Username</th>
						<th>&nbsp<div id="userId">{$user->getUsername()}</div></th>
					</tr>
					<tr>
						<th>Nome</th>
						<th>&nbsp{$user->getName()}</th>
					</tr>
					<tr>
						<th>cognome</th>
						<th>&nbsp{$user->getSurname()}</th>
					</tr>
					<tr>
						<th>E-mail</th>
						<th>&nbsp{$user->getEmail()}</th>
					</tr>
					<tr>
						<th>Corso di laurea</th>
						
						<th>&nbsp{$user->getDegreeCourse()}</th>
					</tr>
				</table>
			</div>
			<div class="col-md-4">
				<div id="votazione">
						<div id="text">{$yourScore}</div>
						{$wantToVote}
						{if $wantToVote}
							<div class="hidden" id="votato">{$hasVoted}</div>
						{/if}
					Punteggio :
					{$votazione=3}
					<br>
							{for $i=1 to 5}
								{if $votazione>=$i}
									<span class="glyphicon glyphicon-star" id='{$i}'></span>
								{else}
									<span class="glyphicon glyphicon-star-empty" id='{$i}'></span>
								{/if}
						
							{/for}	

				</div>	
			</div>	
		</div>
		<div class="row">
			<h1>risorse caricate dall'utente</h1>
			<div class="resource">
				<ul>
					{foreach $resource as $res}
						<tr>
							<td><a href="index.php?controllerAction=resource&resourceAction=getResourcePage&resourceId={$res->getId()}">{$res->getName()}</a></td>
							<td>{$res->getCategory()}</td>
							<td>{$res->getQualityScore()}</td>
							<td>{$res->getDifficultyScore()}</td>
							<td>{$res->getType()}</td>
							<td>{$res->getUploaderUsername()}</td>
							<td>{$res->getDownloadsNumber()}</td>
						</tr>		
					{/foreach}
				</ul>
			</div>
		</div>
	</div>


</div>
 <script src="Smarty_dir/templates/javascript/profile.js"></script> 
<script src="Smarty_dir/templates/javascript/resourcePage.js"></script>
