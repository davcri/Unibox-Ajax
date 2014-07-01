$(function(){

	var degreeCourse;

	$("#degreeCourse").change(function(){
		var selectField = $("#subject");
		selectField.empty();
		degreeCourse = $(this).val();

		$.get("index.php?controllerAction=upload&uploadAction="+degreeCourse, function(data){
			data.forEach(function(element){
				selectField.append("<option>" + element + "</option>");
			});				
		},"json");			
	});	

	$("#uploadButton").click(function(event){
		event.preventDefault();
		
		var formData = {
			"name": $("#name").val(),
			"category": $("#category").val(),
			"degreeCourse": $("#degreeCourse").val(),
			"subject": $("#subject").val()
		};

		$.post("index.php?controllerAction=upload", formData, function(data){
			changePage(data);
		});
	});
});