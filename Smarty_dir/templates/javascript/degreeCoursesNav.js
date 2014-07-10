//todo : tooltip position

$(function(){
	$(document).tooltip();

	$("#mainContent").find("a").click(function(event) {
		event.preventDefault();
	});

	$(".mainContent").find("a").click(function(){
		var url = $(this).attr("href"); 
		
		$.get(url, function(data){
			changePage(data);
			//updateContent(data);
		});
	});
});

/*
function updateContent(newContent){
	$("#mainContent .list-group").slideToggle(animationTime,function(){
			$(this).html(newContent);
			$(this).slideToggle(animationTime);
		});
}*/