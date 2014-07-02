
$(setNavbarBehaviour); // when the DOM is ready, run mainFunction()

var animationTime = 300;

function setNavbarBehaviour(){
	disableNavbarLinksDefault();
	$("#navigationBar").find("li").click(ajaxChangePage);	
	
	// var url = $(this).children().eq(0).attr("href"); 
	// $.get(url, function(data){
	// 	changePage(data);
	// }).fail(function(){
	// 	alert("Errore di connessione")
	// });	
}

//
// Utility functions
//

function toggleActivate(obj){
	$(".active").toggleClass("active");
	obj.addClass("active");
}

function animateSidebar(){
	$("#mainContent").switchClass("col-md-12","col-md-9",animationTime);
	$("#sidebar").show(animationTime*1.5);
}

function changePage(newContent){
	$("#mainContainer").slideToggle(animationTime,function(){
			$("#mainContainer").html(newContent);
			$("#mainContainer").slideToggle(animationTime);
		});
}

function disableNavbarLinksDefault(){
	$("#navigationBar").find("a").click(function(event) {
		event.preventDefault();
	});
}

function ajaxChangePage()
{	
	toggleActivate($(this));		
	
	var url = $(this).children().eq(0).attr("href"); 
	
	$.get(url, function(data){
		changePage(data);
	}).fail(function(){
		alert("Errore di connessione")
	});	
}
