
$(mainFunction); // when the DOM is ready, run mainFunction()

var animationTime = 250;

function mainFunction(){
	cookieCheck();
	setNavbarBehaviour();
	setFooterBehaviour();

	//ajaxLoadingMessage();
}

function setNavbarBehaviour(){
	disableNavbarLinksDefault();
	$("#navigationBar").find("li").click(function(){		
		var url = $(this).children().eq(0).attr("href"); 
		ajaxChangePage(url);
		toggleActivate($(this));
	});
}

function setFooterBehaviour(){
	$("#footer").find("a").click(function(event){
			event.preventDefault();
			var url = $(this).attr("href"); 
			console.log(url);
			ajaxChangePage(url);
	});
}

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
	$('#mainContainer').block();

	$.get(url, function(data){
		$('#mainContainer').unblock();
		changePage(data);
	})
	.fail(function(){

		/* block is a function of blockUI library */
        $('#mainContainer').block({ 
            message: '<h3>Errore di connessione</h3>', 
            css: { border: '1px solid #000' } 
        }); 
        
        $('body').click(function() { 
            $('#mainContainer').unblock(); /* unblock is a function of blockUI library */
        }); 

		//changePage("Errore di connessione.");
	});	
}


/*function infoFooter(){
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