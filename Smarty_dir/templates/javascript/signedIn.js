
$(document).ready(function(){
	$("#logoutForm").submit(function(event){
		event.preventDefault();
	});

	$("#logoutButton").click(function(){
		$.post("index.php?controllerAction=logout", function(data){
			$(".container-fluid").hide(animationTime, function(){
				$("#logoutDiv").remove();
				$('#profile').remove();

				$(this).append(data);
				$(this).show(animationTime);
			});
		});

		if($("#uploadForm").length){ // if there is the upload form, then update the page
			$.get("index.php?controllerAction=upload",function(data){
				changePage(data);
			});
		}

		if($("#profilePage").length){
			$.get("index.php?controllerAction=home",function(data){
				changePage(data);
			});
		}

		var ratingPanel = $("#ratingPanel");
		if(ratingPanel.length){
			$(ratingPanel).hide(animationTime);
		}

	});
});


