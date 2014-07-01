
<div id="mainContent" class="mainContent">			
	<div class="row">
		<div class="col-md-2">
		</div>

		<div class="col-md-8">
			<br>
			<p>Compila la form per registrarti</p>
			<br>

			<form>
				<div class="form-group">
			    	<label>Nome</label>
			    	<input type="text" class="form-control" id="nameUser" placeholder="Nome">
			  	</div>
			  	<div class="form-group">
			    	<label>Cognome</label>
			    	<input type="text" class="form-control" id="surname" placeholder="Cognome">
			  	</div>
				<div class="form-group">
			    	<label>Username</label>
			    	<input type="text" class="form-control" id="usernameRegForm" placeholder="Username">
			  	</div>
			  	<div class="form-group">
			   		<label>Password</label>
			   		<input type="password" class="form-control" id="passwordRegForm" placeholder="Password">
			  	</div>
				<div class="form-group">
			    	<label>Indirizzo Email</label>
			    	<input type="email" class="form-control" id="email" placeholder="Inserici email">
			  	</div>
			  	<div class="form-group">
				  	<label>Corso di Laurea</label>
				  	<select class="form-control" id="degreeCourse" name="degreeCourse">
	          		{foreach $degreeCourses as $opt}
	            		<option value="{$opt->getName()}">{$opt->getName()}</option>
			        {/foreach}
	       			</select>		  				  	
			  	</div>
			  	<button id="submitButton" type="submit" class="btn btn-default">Registrati</button>
			</form>
		</div>
	</div>
</div>

<script src="Smarty_dir/templates/javascript/registration.js"></script>