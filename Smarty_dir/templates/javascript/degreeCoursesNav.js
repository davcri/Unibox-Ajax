//todo : tooltip position

$(function(){
	$("#mainContent").tooltip({position:{my:"right-5%"}}); // for position documentation look http://api.jqueryui.com/position/

	$("#mainContent").find("a").click(function(event) {
		event.preventDefault();
	});

	$(".mainContent").find("a").click(function(){
		var url = $(this).attr("href"); 
		
		ajaxChangePage(url);

		/*$.get(url, function(data){
			changePage(data);
		});*/
	});
});

