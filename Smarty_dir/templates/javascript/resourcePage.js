
$(function(){

	$("#pathBar").find("a").click(function(event){		
		event.preventDefault();

		var url = $(this).attr("href"); 
				
		$.get(url, function(data){
			changePage(data);
		});
	});

	setSliders();
	downloadLinkBehaviour();

	$("#ajaxVote").click(function(event){
		event.preventDefault();

		var button = $(this);
		var sliderQ = $('#difficultySlider');
		var sliderD = $('#qualitySlider');

		var difficulty = sliderD.slider( "option", "value" );
		var quality = sliderQ.slider( "option", "value" );
		var resourceId = $("#resourceId").html();
		var url = $(this).attr("href");

		var resourceVoteInfo = {"difficulty":difficulty,
								"quality":quality,
								"resourceId":resourceId};
		
		// AJAX call
		$.post(url, resourceVoteInfo, function(data){
		    $("#ratingPanel").hide(animationTime, function(){
		    	$(this).remove();
		    	// qui dovrebbe arrivare un bel tpl processato
		    	$("#resourceContainer").append("<p> Grazie per aver votato questa risorsa </p>");
		    });
		    
		},"json");		
	});
	
});

function setSliders(){
	$(".slider").slider({ min: 0, 
		  				  max: 10,
		  				  value: 5,
		  				  animate: "slow"});

	$("#qualitySlider").on("slide", function(event,obj){
		$("#qualityVal").html(obj.value).hide().show("fast");
	});

	$("#difficultySlider").on("slide", function(event,obj){
		$("#difficultyVal").html(obj.value).hide().show("fast");
	});
}

function downloadLinkBehaviour(){
	$("#downloadLink").click(function(){
		var resourceInfo = {"resourceId": $("#resourceId").html()};
		var url = "index.php?controllerAction=resource&resourceAction=incrementDownloadsCount";

		$.post(url, resourceInfo, function(data){
			$("#downloadsCount").html(data.newDownloadsCount) // put the new value in the downloadsCount <span>
			.parent().effect("highlight",{color: "#d8dff0"},3000); // on the div use the highlight effect
		}, "json");
	});
}