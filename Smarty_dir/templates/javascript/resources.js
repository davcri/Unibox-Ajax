
$(function(){
	initializeTablesorter();
	handleTableButtons();
	
	$("#mainContainer").find("a").click(function(event) {
		event.preventDefault();
	});

	$("#mainContainer").find("a").click(function(){		
		var url = $(this).attr("href"); 
		ajaxChangePage(url);

		/*$.get(url, function(data){
			changePage(data);
		});*/
	});

	handleTablesorterInfoLink();
});


function initializeTablesorter(){
	
	// documentation here : http://mottie.github.io/tablesorter/docs/
	var pagerOptions = {
    	// target the pager markup
	    container: $("#tablePager"),
	    // output string - default is '{page}/{totalPages}'; possible variables: {page}, {totalPages}, {startRow}, {endRow} and {totalRows}
	    output: '{startRow} - {endRow} / {filteredRows} ({totalRows})',
	    // if true, the table will remain the same height no matter how many records are displayed. The space is made up by an empty
	    // table row set to a height to compensate; default is false
	    fixedHeight: false,
	    // remove rows from the table to speed up the sort of large tables.
	    // setting this to false, only hides the non-visible rows; needed if you plan to add/remove rows with the pager enabled.
	    removeRows: false,
	    // go to page selector - select dropdown that sets the current page
	    cssGoto: '.gotoPage'										
  	};

  	$("#tableS").hide();
	
	$("#tableS").tablesorter({
		sortList: [[1,0], // sort on the second column, ASC
				   [2,1]], // sort on the third column, DESC 
		theme:'metro-dark',
		//headerTemplate : '{content} {icon}', 
      	widthFixed: true,
      	widgets: ['zebra','filter']
	})
	.tablesorterPager(pagerOptions)
	.show("fade",animationTime+100);
}

function handleTableButtons(){
	$('button').click(function(){
		var columns = [];
		columns[3] = $(this).attr("filter-value");

		$('button').removeClass("active");
		$(this).addClass("active");

		if($(this).attr("id")=="resetFilter")
			$('table').trigger('filterReset');
				
		$('table').trigger('search', [ columns ]);
	});
}

function handleTablesorterInfoLink(){
	$("#tablesorterInfoLink").off("click");
	$("#tablesorterInfo").hide();
	
	$("#tablesorterInfoLink").click(function(){
		$("#tablesorterInfo").slideToggle(animationTime);
	});
}