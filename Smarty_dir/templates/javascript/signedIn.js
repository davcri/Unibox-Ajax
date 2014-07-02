
$(document).ready(function(){
	$("#logoutForm").submit(function(event){
		event.preventDefault();
	});

	$("#logoutButton").click(function(){
		$.post("index.php?controllerAction=logout", function(data){
			$(".container-fluid").hide(animationTime, function(){
				$("#logoutDiv").remove();
				//console.log($("#loginForm"));
				$(this).append(data);
				$(this).show(animationTime);
				$('#profile').remove();
			});
		});

		if($("#uploadForm").length){ // if there is the upload form, then update the page
			$.get("index.php?controllerAction=upload",function(data){
				changePage(data);
			});
		}
	});
});


