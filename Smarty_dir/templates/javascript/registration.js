
$(function(){
	var button = $("#submitButton");

	$(".myTooltip").hide(); // hide all tooltips div

	handleNameInput(button);

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
			url: 'index.php?controllerAction=registration',
			type: 'POST',
			data: formData,})
		.done(function(data){
			changePage(data);
		});
	});
}

function isFormCompleted(){
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

function handleNameInput(submitBtn){
	var nameInput = $("#nameUser");
	var nameTooltip = $("#nameTooltip");
	var default_nameTooltip = nameTooltip.text();

	nameInput.focus(function(){
		nameTooltip.show("fade",animationTime);
	});

	nameInput.blur(function(){
		nameTooltip.hide("fade",animationTime);
	});

	nameInput.keyup(function(){	// validation function
		if($(this).val().length==0){
			$(this).parent().addClass("has-error");
			submitBtn.attr("disabled","disabled");
			nameTooltip.text("Il nome non può essere vuoto").show("fade",animationTime);
		}
		else if($(this).val().length > maxNameChars){
			$(this).parent().addClass("has-error");
			submitBtn.attr("disabled","disabled");
			nameTooltip.text("Il nome non può contenere più di " + maxNameChars + " caratteri").show("fade",animationTime);
		}
		else{
			// nameTooltip.parent().addClass("has-success has-feedback");
			if(isFormCompleted())
				submitBtn.removeAttr("disabled");

			if($(this).parent().hasClass("has-error"))
			{
				$(this).parent().removeClass("has-error");
				nameTooltip.text(default_nameTooltip);						
			}			
		}		
	});
}