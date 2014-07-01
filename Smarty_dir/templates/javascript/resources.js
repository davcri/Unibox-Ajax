
$(function(){
	$("#mainContent").find("a").click(function(event) {
		event.preventDefault();
	});

	$("#pathBar").find("a").click(function(){		
		var url = $(this).attr("href"); 
				
		$.get(url, function(data){
			changePage(data);
		});
	});		

	behaviour();
})

function behaviour()
{
	$(".accordion").accordion({ collapsible: true, 
								active: false, 
								heightStyle: "content"});
	
	$(".slider").slider({ min: 0, 
		  				  max: 10,
		  				  value: 5,
		  				  animate: "slow"});

	$(".jqButton").click(function ()
	{
		$(this).next().slideToggle("slow");
	})

	$(".ajaxVote").click(function()
	{
		var container = $(this).parent().parent();	
		var resourceId = container.attr("id");
		
		var button = $(this);
		var sliderQ = $('#sliderQ'+resourceId);
		var sliderD = $('#sliderD'+resourceId);

		var difficulty = sliderD.slider( "option", "value" );
		var quality = sliderQ.slider( "option", "value" );
		
		// AJAX call
		$.post("index.php",
			  {"controllerAction": "rateResource", "resourceId":resourceId, "difficulty":difficulty, "quality":quality},
			  function(data)
			  {
			  	//container.filter(".jqButton").hide("slow");
			  	
			  	//var rateBox = container.find(".hidden");
			  	var rateBox = container.find("*:not(a)");
			  	
			  	//container.find(".jqButton").hide("slow");
			  	

			  	rateBox.hide("slow",function()
			  	{
			  		//console.log(data);
			  		rateBox.next().remove("*"); // remove all the html elementes in the rateBox
			  		
			  		var newHtml = "Nuovi punteggi :<p>Difficoltà risorsa : " + 
			  		              data.difficulty + "</p>" + "<p>Qualità risorsa : " + data.quality + "</p>" +
			  		              "Grazie per aver votato questa risorsa";

			  		rateBox.html(newHtml).show("slow");
			  	});
			  },"json");
	});

}
