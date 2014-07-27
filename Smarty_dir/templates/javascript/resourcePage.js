
$(function(){
	$("#mainContent").tooltip({position:{my:"center+50px", at:"center"}});

	$("#userLink").find("a").click(function(event){		
		event.preventDefault();
		var url = $(this).attr("href"); 
				
		$.get(url, function(data){
			changePage(data);
		});
	});

	$("#pathBar").find("a").click(function(event){		
		event.preventDefault();

		var url = $(this).attr("href"); 
		ajaxChangePage(url);

		/*$.get(url, function(data){
			changePage(data);
		});*/
	});

	downloadLinkBehaviour();
	setSliders();
	resourceVote();
	
	//filePreview();
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

function resourceVote(){
	$("#ajaxVote").click(function(event){
		event.preventDefault();

		var button = $(this);
		var sliderD = $('#difficultySlider');
		var sliderQ = $('#qualitySlider');

		var difficulty = sliderD.slider( "option", "value" );
		var quality = sliderQ.slider( "option", "value" );
		var resourceId = $("#resourceId").html();
		var url = $(this).attr("href");

		var resourceVoteInfo = {"difficulty":difficulty,
								"quality":quality,
								"resourceId":resourceId};
		
		// AJAX call
		$.post(url, resourceVoteInfo, function(data){
		    $("#ratingPanel").hide(animationTime+500, function(){
		    	$(this).remove();
		    	$("#resourceContainer").children().eq(0).append("<div class=\"alert alert-info text-center\">Grazie per aver votato questa risorsa</div>");
		    	
		    	$("#qualityScore").html(data.newQuality)
		    	.parent().effect("highlight",{color: "#d8dff0"},3000);
		    	
		    	$("#difficultyScore").html(data.newDifficulty)
		    	.parent().effect("highlight",{color: "#d8dff0"},3000);
		    });	
		},"json");		
	});
}

/*function filePreview(){
	$("h1").click(function(){
		$("#resourcePanel").switchClass("col-md-12","col-md-6",animationTime+250, function(){
			
		});
		$("#filePreview").switchClass("hidden", "col-md-6",animationTime);//show("slide", animationTime+250);
	});
}*/