
$(function(){
	var button = $("#submitButton");
 	
 	/* If you want to change these values, remember to change also the values in Control/Registration.php */
 	var formMaxChars = {
 		name: 30,
 		surname: 30,
 		username: 30,
 		password: 30
 	};
 	
	$(".myTooltip").hide(); // hide all tooltips div

	handleNameInput(button, formMaxChars);
	handleSurnameInput(button, formMaxChars);
	handleUsernameInput(button, formMaxChars);
	handlePasswordInput(button, formMaxChars);

	submitButton(button);	
});

function submitButton(btn){
	$("#registrationForm").change(function(){			
		if(isFormCompleted()){
			btn.removeAttr("disabled");
		}
		else
			btn.attr("disabled","disabled");	
	});	

	$("#registrationForm").submit(function(event){
		event.preventDefault();	

		var formData = new FormData(this);

		$.ajax({
			url: 'index.php?controllerAction=registration&registrationAction=addNewUser',
			type: 'POST',
			data: formData,
			processData: false,
			contentType: false})
		.done(function(data){
			changePage(data);
		});
	});
}

function handleNameInput(submitBtn, formMaxChars){
	var nameInput = $("#nameUser");
	var nameTooltip = $("#nameTooltip");
	var default_nameTooltip = nameTooltip.text();

	nameInput.focus(function(){
		nameTooltip.show("fade", animationTime);
	});

	nameInput.blur(function(){
		nameTooltip.hide("fade", animationTime);
	});

	nameInput.keyup(function(){	// validation function
		if($(this).val().length==0){
			$(this).parent().addClass("has-error");
			submitBtn.attr("disabled","disabled");
			nameTooltip.text("Il nome non può essere vuoto").show("fade", animationTime);
		}
		else if($(this).val().length > formMaxChars.name){
			$(this).parent().addClass("has-error");
			submitBtn.attr("disabled","disabled");
			nameTooltip.text("Il nome non può contenere più di " + formMaxChars.name + " caratteri").show("fade", animationTime);
		}
		else{
			// nameTooltip.parent().addClass("has-success has-feedback");
			if(isFormCompleted(formMaxChars))
				submitBtn.removeAttr("disabled");

			if($(this).parent().hasClass("has-error"))
			{
				$(this).parent().removeClass("has-error");
				nameTooltip.text(default_nameTooltip);						
			}			
		}		
	});
}

function handleSurnameInput(submitBtn, formMaxChars){
	var surnameInput = $("#surname");
	var surnameTooltip = $("#surnameTooltip");
	var default_surnameTooltip = surnameTooltip.text();

	surnameInput.focus(function(){
		surnameTooltip.show("fade", animationTime);
	});

	surnameInput.blur(function(){
		surnameTooltip.hide("fade", animationTime);
	});

	surnameInput.keyup(function(){	// validation function
		if($(this).val().length==0){
			$(this).parent().addClass("has-error");
			submitBtn.attr("disabled","disabled");
			surnameTooltip.text("Il nome non può essere vuoto").show("fade", animationTime);
		}
		else if($(this).val().length > formMaxChars.surname){
			$(this).parent().addClass("has-error");
			submitBtn.attr("disabled","disabled");
			surnameTooltip.text("Il cognome non può contenere più di " + formMaxChars.surname + " caratteri").show("fade", animationTime);
		}
		else{
			if(isFormCompleted(formMaxChars))
				submitBtn.removeAttr("disabled");

			if($(this).parent().hasClass("has-error"))
			{
				$(this).parent().removeClass("has-error");
				surnameTooltip.text(default_surnameTooltip);						
			}			
		}		
	});
}

function handleUsernameInput(submitBtn, formMaxChars){
	var usernameInput = $("#usernameRegForm");
	var usernameTooltip = $("#usernameTooltip");
	var default_usernameTooltip = usernameTooltip.text();

	usernameInput.focus(function(){
		usernameTooltip.show("fade", animationTime);
	});

	usernameInput.blur(function(){
		usernameTooltip.hide("fade", animationTime);
	});

	usernameInput.keyup(function(){	// validation function
		var textInput = $(this).val();
		var input = {'usernameInserted': textInput}
		var inputForm = $(this).parent();

		if(textInput.length==0){
			inputForm.addClass("has-error");
			submitBtn.attr("disabled","disabled");
			usernameTooltip.text("Il campo username non può essere vuoto").show("fade", animationTime);
		}
		else if(textInput.length > formMaxChars.username){
			inputForm.addClass("has-error");
			submitBtn.attr("disabled","disabled");
			usernameTooltip.text("Il campo username non può contenere più di " + formMaxChars.username + " caratteri").show("fade", animationTime);
		}
		else{
			$.get("index.php?controllerAction=registration&registrationAction=checkUsername", input, function(data){
				if(data.usernameExists){
					usernameTooltip.text("L'username è già stato preso.");
					inputForm.addClass("has-error");
					submitBtn.attr("disabled","disabled");
				}
				else{
					if(isFormCompleted(formMaxChars))
						submitBtn.removeAttr("disabled");

					console.log(inputForm);
					if(inputForm.hasClass("has-error"))
					{
						console.log("asd");
						inputForm.removeClass("has-error");
						usernameTooltip.text(default_usernameTooltip);						
					}		
				}
			},"json");				
		}		
	});
}

function handlePasswordInput(submitBtn, formMaxChars){
	var passwordInput = $("#passwordRegForm");
	var passwordTooltip = $("#passwordTooltip");
	var default_usernameTooltip = passwordTooltip.text();

	passwordInput.focus(function(){
		passwordTooltip.show("fade", animationTime);
	});

	passwordInput.blur(function(){
		passwordTooltip.hide("fade", animationTime);
	});

	passwordInput.keyup(function(){	// validation function
		if($(this).val().length==0){
			$(this).parent().addClass("has-error");
			submitBtn.attr("disabled","disabled");
			passwordTooltip.text("Il campo password non può essere vuoto").show("fade", animationTime);
		}
		else if($(this).val().length > formMaxChars.password){
			$(this).parent().addClass("has-error");
			submitBtn.attr("disabled","disabled");
			passwordTooltip.text("La password non può contenere più di " + formMaxChars.password + " caratteri").show("fade", animationTime);
		}
		else{
			if(isFormCompleted(formMaxChars))
				submitBtn.removeAttr("disabled");

			if($(this).parent().hasClass("has-error"))
			{
				$(this).parent().removeClass("has-error");
				passwordTooltip.text(default_usernameTooltip);						
			}			
		}		
	});
}

function isFormCompleted(formMaxChars){
	var completed = false;

	if($("#nameUser").val().length > 0 && 
	   $("#surname").val().length > 0 &&
	   $("#usernameRegForm").val().length > 0 &&
	   $("#passwordRegForm").val().length > 0 &&
	   $("#email").val().length > 0 &&
	   $("#degreeCourse").val().length > 0)
	{
		completed = true;
	}

	return completed;
}
