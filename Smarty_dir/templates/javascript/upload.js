$(function(){

	var degreeCourse;

	$("#degreeCourse").change(function(){
			degreeCourse = $(this).val();

			$.get("index.php?controllerAction=upload&uploadAction="+degreeCourse, function(data){
				data.forEach(function(element){
					$("#subject").append("<option>" + element + "</option>");
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

		console.log(formData);
	});
});