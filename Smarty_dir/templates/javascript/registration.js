
$(function(){
	$("#submitButton").click(function(event){
		event.preventDefault();

		var username = $("#usernameRegForm").val();
		var password = $("#passwordRegForm").val();
		var name = $("#nameUser").val();
		var surname = $("#surname").val();		
		var email = $("#email").val();
		var degreeCourse = $("#degreeCourse").val();

		var signInData = {
			"username": username,
			"password": password,
			"nameUser": name,
			"surname": surname,
			"email": email,
			"degreeCourse": degreeCourse
		}

		$.post("index.php?controllerAction=registration", signInData, function(data){
			changePage(data);
		})
	});
});