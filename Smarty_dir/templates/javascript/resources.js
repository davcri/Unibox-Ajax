
$(function(){

	$("#tableS").tablesorter({
		theme:'metro-dark'
	});

	$("#mainContent").find("a").click(function(event) {
		event.preventDefault();
	});

	$("#pathBar").find("a").click(function(){		
		var url = $(this).attr("href"); 
				
		$.get(url, function(data){
			changePage(data);
		});
	});

	$("#resourcesContainer").find("a").click(function(){
		var url = $(this).attr("href"); 

		$.get(url, function(data){
			changePage(data);
		});
	});			
});
