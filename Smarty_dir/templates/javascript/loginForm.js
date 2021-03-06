	
$(function(){
	$("#loginForm").submit(function(event) {
		event.preventDefault();
	});

	checkLogin();
	
	$("#signInButton").click(function(){
		ajaxChangePage("index.php?controllerAction=registration&registrationAction=getRegistrationPage");

		/*$.get(,function(data){
			changePage(data);
		});*/
	});
});

function checkLogin(){
	$("#loginButton").click(function(){
		var username = $("#username").val();
		var password = $("#password").val();
		var rememberMe = $("#rememberMe").prop("checked");	
		var loginData = {"username": username, "password": password, "rememberMe": rememberMe};

		setLoadingMessage();

		$("#loginButton").off(); //prevent a bug when clicking quickly on loginButton (or pressing enter quickly)
		
		$.post("index.php?controllerAction=login", loginData, function(data){

			//used to simulate slow connections
			setTimeout(function(){
				$('#mainContainer').unblock();
			}, simulateConnectionDelay); 
			
			if(data.statusCode==1){ // login correct 
				$("#navbarContent").hide("fade",animationTime, function(){
					$("#loginForm").remove();
					$(this).append(data.content);
					
					$('#navigationBar').append(data.profile);
					
					disableNavbarLinksDefault();

					$('#profile').find("a").click(function(){
						var url = $(this).attr("href"); 
						ajaxChangePage(url);
						console.log($(this).parent());
						toggleActivate($(this).parent());
					});

					$(this).show(animationTime);
				});

				if($(".active").eq(0).attr("id")=="upload"){ // if the selected page in the navbar is upload
					$.get("index.php?controllerAction=upload&uploadAction=getUploadPage",function(data){
						changePage(data);
					});
				}

				handleRatingPanel();

				// this is needed only to select the correct page when a user fails a login and then logs in correctly
				if($("#loginFailed").length){ 
					var currentActivePage = $(".active").attr("id");
					$.get("index.php?controllerAction="+currentActivePage,function(data){
						changePage(data);
					});
				}			
			}
			else{ // login failed
			 	checkLogin(); // we need to restore the events handlers

				changePage(data.content);
			}
		},"json");
	});
}
	
function handleRatingPanel(){

	var ratingPanel = $("#ratingPanel");
	$("#loginRequiredForResourceRating").hide();
	
	if(ratingPanel.length){
		$(ratingPanel).removeClass("hidden").hide().show(animationTime);
	}
}