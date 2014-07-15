
<div id="mainContent" class="mainContent">			
	<br>
	<p>Compila la form per registrarti</p>
	<br>

	<form id="registrationForm" enctype="multipart/form-data">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
			    	<label>Nome</label>
			    	<input type="text" name="nameUser" class="form-control" id="nameUser" placeholder="Nome">
			  	</div>
			</div>
			<div class="col-md-6">
				<div id="nameTooltip" class="col-md-6 myTooltip">
            		Inserisci il tuo nome
        		</div>
			</div>
		</div>

		<div class="row">
	  		<div class="col-md-6">
			  	<div class="form-group">
			    	<label>Cognome</label>
			    	<input type="text" name="surname" class="form-control" id="surname" placeholder="Cognome">
			  	</div>
			</div>
			<div class="col-md-6">
				<div id="surnameTooltip" class="col-md-6 myTooltip">
            		Inserisci il tuo cognome
        		</div>
			</div>
		</div>
		
		<div class="row">
	  		<div class="col-md-6">
				<div class="form-group">
			    	<label>Username</label>
			    	<input type="text" name="username" class="form-control" id="usernameRegForm" placeholder="Username">
			  	</div>
			</div>
			<div class="col-md-6">
				<div id="usernameTooltip" class="col-md-6 myTooltip">
            		Inserisci l'username desiderato
        		</div>
			</div>
		</div>

		<div class="row">
	  		<div class="col-md-6">
			  	<div class="form-group">
			   		<label>Password</label>
			   		<input type="password" name="password" class="form-control" id="passwordRegForm" placeholder="Password">
			  	</div>
			</div>
			<div class="col-md-6">
				<div id="passwordTooltip" class="col-md-6 myTooltip">
            		Inserisci la password desiderata
        		</div>
			</div>
		</div>

		<div class="row">
	  		<div class="col-md-6">
				<div class="form-group">
			    	<label>Indirizzo Email</label>
			    	<input type="email" name="email" class="form-control" id="email" placeholder="Inserici email">
			  	</div>
			</div>
			<div class="col-md-6">
				<div id="emailTooltip" class="col-md-6 myTooltip">
            		Inserisci la tua email
        		</div>
			</div>
		</div>

		<div class="row">
	  		<div class="col-md-6">
			  	<div class="form-group">
				  	<label>Corso di Laurea</label>
				  	<select class="form-control" id="degreeCourse" name="degreeCourse">
		      		{foreach $degreeCourses as $opt}
		        		<option value="{$opt->getName()}">{$opt->getName()}</option>
			        {/foreach}
		   			</select>		  				  	
			  	</div>
			</div>
		</div>

	  	<button id="submitButton" type="submit" class="btn btn-success" disabled="disabled">Invia dati</button>

	</form>
</div>

<script src="Smarty_dir/templates/javascript/registration.js"></script>