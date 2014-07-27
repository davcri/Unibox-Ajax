
$(function(){
	$("#mainContent").tooltip({position:{my:"right-5%"}}); // for position documentation look http://api.jqueryui.com/position/

	$("#mainContainer").find("a").click(function(event) {
		event.preventDefault();
	});

	$("#mainContainer").find("a").click(function(){		
		
		var url = $(this).attr("href"); 
		ajaxChangePage(url);

		/*$.get(url, function(data){
			changePage(data);
		});*/
	});		
});
