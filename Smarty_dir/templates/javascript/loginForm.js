	
$(function(){
	$("#loginForm").submit(function(event) {
		event.preventDefault();
	});

	$("#loginButton").click(function(){
		var username = $("#username").val();
		var password = $("#password").val();
		var loginData = {"username":username, "password":password};

		$.post("index.php?controllerAction=login", loginData, function(data){
			if(data.statusCode==1){
				$(".container-fluid").hide("fade",animationTime, function(){
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

				/*var ratingPanel = $("#ratingPanel");
				if(ratingPanel.length){
					if (ratingPanel.hasClass("hidden")) {
						$("#loginRequiredForResourceRating").hide(animationTime,function(){$(this).remove();});
						ratingPanel.removeClass("hidden").hide();
					}

					ratingPanel.show(animationTime);
				}*/

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
	