	
$(function(){
	$("#loginForm").submit(function(event) {
		event.preventDefault();
	});

	$("#loginButton").click(function(){
		var username = $("#username").val();
		var password = $("#password").val();
		var loginData = {"username":username, "password":password};

		$.post("index.php?controllerAction=login", loginData, function(data){
			if(data.statusCode==1) {
				$(".container-fluid").hide(animationTime, function(){
					$("#loginForm").remove();
					$(this).append(data.content);
					$(this).show(animationTime);
				});

				if($("#loginRequired").length){ // login required is an alert found only on the upload page
					$.get("index.php?controllerAction=upload",function(data){
						changePage(data);
					});
				}

				// this is needed only to select the correct page when a user fails a login and then logs in correctly
				if($("#loginFailed").length){ 
					var currentActivePage = $(".active").attr("id");
					$.get("index.php?controllerAction="+currentActivePage,function(data){
						changePage(data);
					});
				}				
			}
			else{
				changePage(data.content);
			}
		},"json");
	});

	$("#signInButton").click(function(){
		$.get("index.php?controllerAction=registration",function(data){
			changePage(data);
		});
	});
});
	