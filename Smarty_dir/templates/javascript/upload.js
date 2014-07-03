
$(function(){

	$("#uploadForm").submit(function(event) {
		event.preventDefault();	

		var formData = new FormData(this);

		// for details and explanation read: http://stackoverflow.com/questions/5392344/sending-multipart-formdata-with-jquery-ajax 
		// processData and contentType need to be false, otherwise the ajax call will fail.
		$.ajax({
			url: 'index.php?controllerAction=upload',
			type: 'POST',
			data: new FormData(this),
			processData: false,
			contentType: false
		}).done(function(data){
			changePage(data);
		});
	});

	var degreeCourse;

	$("#degreeCourse").change(function(){
		var selectField = $("#subject");
		selectField.empty();
		degreeCourse = $(this).val();

		$.get("index.php?controllerAction=upload&uploadAction=" + degreeCourse, function(data){
			data.forEach(function(element){
				selectField.append("<option>" + element + "</option>");
			});				
		},"json");			
	});	
});
