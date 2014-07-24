
$(function(){

	var username=$('#userId').html();
	if($('#votato').size()){
		var hasAlreadyVoted=$('#votato').html();
		//console.log(hasAlreadyVoted);
		if(hasAlreadyVoted==false){
			var star=$(".glyphicon-star").size();

			$("#votazione").find("span").mouseover(function(){
				var numero = $(this).attr("id");
				colorStar(numero);
				$("#votazione").css('cursor', 'pointer');
			 	//$(this).switchClass('glyphicon-star-empty', 'glyphicon-star');
			});

			$("#votazione").mouseout( function(){
				colorStar(star);
			});

			$("#votazione").find("span").click(function(data){
				//event.preventDefault();
				var actualVote=$(this).attr("id");
				//var username=$('#userId').html();
				if( confirm("sei sicuro di voler attribuire all'utente "+username+" il voto : "+actualVote)){
					$.get("index.php?controllerAction=profile&profileAction=rateUser&userProfile="+username+"&vote="+actualVote, function(data){
						alert(data);
						$("#votazione").find("span").off();// in questo modo disabilito il mousover dopo che l'utente ha votato
						$("#votazione").css('cursor', 'default'); 


					});
				}
					
			});
		}
		else{
			alert("hei! ricorda che hai giá votato questo utente!");
		}

	}
	
	//controllo se l'utente visitatore ha gia votato questo user
	//userRated=username
	//$.get("index.php?controllerAction=navigation&profileAction=hasAlreadyVoted&userRated=username", function(data){
		//alert(data);
		//console.log(data);
	$(".resource").find("a").click(function(event){		
		event.preventDefault();
		var url = $(this).attr("href"); 
				
		$.get(url, function(data){
			changePage(data);
		});
	});

});

function colorStar(numero){

	for (i=1; i<6; i++){
		if( numero >= i){
			$("#"+ i).switchClass('glyphicon-star-empty', 'glyphicon-star');
		}
		else{
			$("#"+ i).switchClass('glyphicon-star', 'glyphicon-star-empty');
		}
	}
}
