
$(setNavbarBehaviour); // when the DOM is ready, run mainFunction()

var animationTime = 250;

function setNavbarBehaviour(){
	disableNavbarLinksDefault();
	cookieCheck();
	$("#navigationBar").find("li").click(ajaxChangePage);	

	//ajaxLoadingMessage();
}


//
// Utility functions
//
function cookieCheck(){
	if (!cookiesEnabled())
		$("#cookieAlert").removeClass("hidden").show();
}

function cookiesEnabled(){
	return navigator.cookieEnabled;
}

function toggleActivate(obj){
	$(".active").toggleClass("active");
	obj.addClass("active");
}

function animateSidebar(){
	$("#mainContent").switchClass("col-md-12","col-md-9",animationTime);
	$("#sidebar").show(animationTime*1.5);
}

function changePage(newContent){
	/*$("#mainContainer").slideToggle(animationTime,function(){
			$("#mainContainer").html(newContent);
			$("#mainContainer").slideToggle(animationTime);
		});*/
	var mainContainer = $("#mainContainer");
	var footer = $("#footer");

	mainContainer.toggle("fade","linear", animationTime,function(){
		mainContainer.html(newContent); 
		mainContainer.toggle("fade", "linear",animationTime);
	});

	footer.toggle("fade","linear",animationTime,function(){
		footer.toggle("fade","linear",animationTime);
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
	})
	.fail(function(){
		changePage("Errore di connessione.");
	});	
}

/*
function userIsLogged()
{
	// questa funzione è molto debole ! Basta che un malintenzionato crei un qualsiasi tag html con id="loginForm" per 
	// effettuare un exploit di questa funzione. 
	if($("#loginForm").length)
		return false;
	else
		return true;
}*/

/*
function ajaxLoadingMessage(){
	body = $("body");

	$(document).on({
		ajaxStart: function() { 
			body.addClass("loading");
		 },
		 ajaxStop: function() { 
		 	body.removeClass("loading"); 
		 }    
	});
}
*/