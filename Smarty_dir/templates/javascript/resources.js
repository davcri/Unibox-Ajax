
$(function(){
	initializeTablesorter();

	$("#mainContent").find("a").click(function(event) {
		event.preventDefault();
	});

	$("#pathBar").find("a").click(function(){		
		var url = $(this).attr("href"); 
				
		$.get(url, function(data){
			changePage(data);
		});
	});

	$("#resourcesContainer").find("a").click(function(){
		var url = $(this).attr("href"); 

		$.get(url, function(data){
			changePage(data);
		});
	});			
});

function initializeTablesorter(){

	var pagerOptions = {
    	// target the pager markup - see the HTML block below
	    container: $("#tablePager"),
	    // output string - default is '{page}/{totalPages}'; possible variables: {page}, {totalPages}, {startRow}, {endRow} and {totalRows}
	    output: '{startRow} - {endRow} / {filteredRows} ({totalRows})',
	    // if true, the table will remain the same height no matter how many records are displayed. The space is made up by an empty
	    // table row set to a height to compensate; default is false
	    fixedHeight: true,
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
		headerTemplate : '{content} {icon}', // new in v2.7. Needed to add the bootstrap icon!
      	widthFixed: true,
      	widgets: ['zebra','filter']
	})
	.tablesorterPager(pagerOptions).show("fade",animationTime+500);
	//.tablesorterPager(pagerOptions).delay(500).show("slide",animationTime+500);
}