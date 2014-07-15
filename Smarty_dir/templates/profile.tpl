<div id="profilePage">
	<div id="mainContent" class="mainContent">
		<div class="row">
			<div class="col-md-8">
				<table>
					<tr>
						<th>Username</th>
						<th>&nbsp{$username}</th>
					</tr>
					<tr>
						<th>Nome</th>
						<th>&nbsp{$name}</th>
					</tr>
					<tr>
						<th>cognome</th>
						<th>&nbsp{$surname}</th>
					</tr>
					<tr>
						<th>E-mail</th>
						<th>&nbsp{$email}</th>
					</tr>
					<tr>
						<th>Corso di laurea</th>
						
						<th>&nbsp{$degreeCourse}</th>
					</tr>
				</table>
			</div>

			<div class="col-md-4">
				<div id="votazione">
					votazione :
					{$votazione=3}
					<div id="vot">{$votazione}</div>
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
						<li><a href="index.php?controllerAction=resource&resourceAction=getResourcePage&resourceId=id">{$res->getName()}</li>
					{/foreach}
				</ul>
			</div>
		</div>
	</div>


</div>
<script src="Smarty_dir/templates/javascript/profile.js"></script>