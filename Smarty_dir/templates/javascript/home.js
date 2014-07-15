
$(function(){
	var list = $(".mainContent").find(".list-group");
	list.hide();
	
	$("#moreInfo").click(function(){
		var btn = $(this);

		list.slideToggle(animationTime, function(){
			if (list.css("display")==="none")
				btn.html("<span class=\"glyphicon glyphicon-plus\"></span> Scopri di pi&ugrave");
			else
				btn.html("<span class=\"glyphicon glyphicon-minus\"></span> Riduci");
		});		
	});
});
