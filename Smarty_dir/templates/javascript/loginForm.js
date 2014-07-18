	
$(function(){
	$("#loginForm").submit(function(event) {
		event.preventDefault();
	});

	checkLogin();
	
	$("#signInButton").click(function(){
		$.get("index.php?controllerAction=registration&registrationAction=getRegistrationPage",function(data){
			changePage(data);
		});
	});
});

function checkLogin(){
	$("#loginButton").click(function(){
		var username = $("#username").val();
		var password = $("#password").val();
		var loginData = {"username":username, "password":password};

		$("#loginButton").off(); //prevent a bug when clicking quickly on loginButton (or pressing enter quickly)
		
		$.post("index.php?controllerAction=login", loginData, function(data){
			if(data.statusCode==1){
				$("#navbarContent").hide("fade",animationTime, function(){
					$("#loginForm").remove();
					$(this).append(data.content);
					
					$('#navigationBar').append(data.profile);
					
					disableNavbarLinksDefault();
					$('#profile').click(ajaxChangePage);

					$(this).show(animationTime);
				});

				if($("#loginRequired").length){ // 'loginRequired' is an alert found only on the upload page
					$.get("index.php?controllerAction=upload&uploadAction=getUploadPage",function(data){
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
			 	checkLogin(); // we need to restore the events handlers

				changePage(data.content);
			}
		},"json");
	});
}
	