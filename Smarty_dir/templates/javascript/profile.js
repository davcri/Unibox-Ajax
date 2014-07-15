/*
$( "#star" ).mouseover(function() {
  $( "#star" ).switchClass('glyphicon-star-empty', 'glyphicon-star');
});
*/

$(function(){
	var star=$(".glyphicon-star").size();

	$("#votazione").find("span").mouseover(
		function(){
			numero=$(this).attr("id");
			colorStar(numero);
	 //$(this).switchClass('glyphicon-star-empty', 'glyphicon-star');
	});
	$("#votazione").mouseout( function(){
		colorStar(star);
	});
	$("#votazione").find("span").click(function(){
		var actualVote=$(this).attr("id");
		$.get("index.php?controllerAction=profile?vote=actualVote"
	})
});

	function colorStar(numero){

		for (i=1; i<6;i++){
			if( numero >= i){
				$("#"+ i).switchClass('glyphicon-star-empty', 'glyphicon-star');
			}
			else{
				$("#"+ i).switchClass('glyphicon-star', 'glyphicon-star-empty');
			}
		}
	}
