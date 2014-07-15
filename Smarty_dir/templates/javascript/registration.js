
$(function(){
	var button = $("#submitButton");

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