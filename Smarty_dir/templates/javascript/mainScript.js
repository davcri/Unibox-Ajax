
$(mainFunction); // when the DOM is ready, run mainFunction()

var animationTime = 250;

function mainFunction(){
	cookieCheck();
	setNavbarBehaviour();

	//ajaxLoadingMessage();
}

function setNavbarBehaviour(){
	disableNavbarLinksDefault();
	$("#navigationBar").find("li").click(function(){		
		var url = $(this).children().eq(0).attr("href"); 
		ajaxChangePage(url);
		toggleActivate($(this));
	});
	//infoFooter();

}


//
// Utility functions
//
/*
1 - l'html non andrebbe mischiato nel javascript
2 - c'è un errore di sintassi. Devi fare l'escape degli apici "" con lo slash altrimenti ti chiude la stringa.
3- è più facile fare altre 3 pagine. Direi di creare altri tpl per quante pagine vogliamo. così è tutto più facile e ordinato

function infoFooter(){
	$("#weAre").mouseover(function(event){
		event.preventDefault;
		$(#weAre).append("<br><br>
		<address>
	  		<strong>Davide Cristini</strong><br>
	 		email : <a href="mailto:davcri91@gmail.com">davcri91@gmail.com</a>  
	 	</address>
	 	<address>
	 		<strong>Filippo Reggimenti</strong><br>
	 		email : <a href="mailto:reggimenti.filippo.com">reggimenti.filippo.com</a><br>
		<address> <br> 	");
	});

}*/

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
	var mainContainer = $("#mainContainer");
	var footer = $("#footer");

	mainContainer.toggle("fade","linear", animationTime,function(){
		mainContainer.html(newContent); 
		mainContainer.toggle("fade", "linear",animationTime);
	});
	/*$("#mainContainer").slideToggle(animationTime,function(){
		$("#mainContainer").html(newContent);
		$("#mainContainer").slideToggle(animationTime);
	});*/

	footer.toggle("fade","linear",animationTime,function(){
		footer.toggle("fade","linear",animationTime);
	});
}

function disableNavbarLinksDefault(){
	$("#navigationBar").find("a").click(function(event) {
		event.preventDefault();
	});
}

function ajaxChangePage(url)
{	
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