
$(mainFunction); // when the DOM is ready, run mainFunction()

var animationTime = 250; // 250 milliseconds
var simulateConnectionDelay = 0; // in milliseconds

function mainFunction(){
	cookieCheck();
	setNavbarBehaviour();
	setFooterBehaviour();
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
	$("#footer").find("a[ajax='true']").click(function(event){
		event.preventDefault();
		var url = $(this).attr("href"); 
		ajaxChangePage(url);
	});
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

// unused
/*function animateSidebar(){
	$("#mainContent").switchClass("col-md-12","col-md-9",animationTime);
	$("#sidebar").show(animationTime*1.5);
}*/

function changePage(newContent){
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

function ajaxChangePage(url)
{	
	setLoadingMessage();

	$.get(url)
	.done(function(data){
		setTimeout(function(){
			$('#mainContainer').unblock();
			changePage(data);
		}, simulateConnectionDelay); 		
	})
	.fail(function(){
        $('#mainContainer').block({ /* block is a function of blockUI library */
            message: '<h3>Errore di connessione</h3>', 
            css: { border: '1px solid #000' } 
        }); 
        
        $('body').click(function() { 
            $('#mainContainer').unblock(); /* unblock is a function of blockUI library */
        }); 
	});	
}

// This method blocks the UI ! Remember to unblock it with .unblock();
function setLoadingMessage(){
	var spinner = $("<div class=\"spinner\"><div> </div></div>");
	
	// for info about this method look here : http://jquery.malsup.com/block/#options
	$('#mainContainer').block({message:spinner, 
							   fadeIn: 300,
							   css:{ 	
							        textAlign:      '', 
							        color:          '#000', 
							        border:         '1px solid #aaa', 
							        backgroundColor:'#fff'
							    }}
	);
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