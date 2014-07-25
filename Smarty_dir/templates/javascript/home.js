
$(function(){
	
	/*$(".panel").find(".table").hide();
	
	$(".panel").hover(function(){
		$(this).find(".table").show("slide", {direction:"up"}, animationTime*2);
	}, function(){
		$(this).find(".table").hide("slide", {direction:"up"}, animationTime*2);
	});*/

	$("#mostActiveUsers").find("a").click(function(event){
		event.preventDefault();
		ajaxChangePage($(this).attr("href"));
	});
});
