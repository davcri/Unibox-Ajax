
//todo : fix tooltips animation. Instead of "fade" effect we can use "bounce" or something like that.
//todo : decide if all form's field should become green after their. Now only name input has this behaviour.
//todo : add controls in PHP code.

$(function(){
	var uploadButton = $("#uploadButton");

	$(".myTooltip").hide(); // hide all tooltips div
	
	handleNameInput(uploadButton);
	handleSubjectInput();
	
	handleDescriptionInput(); // useless until we implement the description field
	$("#description").wrap("<fieldset disabled>","</fieldset>"); // disable the description input. It isn't implemented yet :(
	$("#description").text("todo");

	handleUploadButton(uploadButton);

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
});

function handleNameInput(uploadBtn)
{
	var maxCharCount = 10;
	var nameInput = $("#name");
	var nameTooltip = $("#nameTooltip");
	var default_nameTooltip = nameTooltip.text();

	nameInput.focus(function(){
		nameTooltip.show("fade",animationTime);
	});

	nameInput.blur(function(){
		nameTooltip.hide("fade",animationTime);
	});

	nameInput.keyup(function(){	// validation
		
		if($(this).val().length==0){
			$(this).parent().addClass("has-error");
			uploadBtn.attr("disabled","disabled");
			nameTooltip.text("Il nome non può essere vuoto").show("fade",animationTime);
		}
		else if($(this).val().length > maxCharCount){
			$(this).parent().addClass("has-error");
			uploadBtn.attr("disabled","disabled");
			nameTooltip.text("Il nome non può contenere più di " + maxCharCount + " caratteri").show("fade",animationTime);
		}
		else{
			// nameTooltip.parent().addClass("has-success has-feedback");
			if($(this).parent().hasClass("has-error"))
			{
				$(this).parent().removeClass("has-error");
				nameTooltip.text(default_nameTooltip);

				if(isFormCompleted())
					uploadBtn.removeAttr("disabled");		
			}			
		}		
	});
}

function handleSubjectInput(){
	var selectField = $("#subject");

	var degreeCourse;

	$("#degreeCourse").change(function(){
		selectField.empty(); // remove all previous loaded subjects
		degreeCourse = $(this).val();

		$.get("index.php?controllerAction=upload&uploadAction=" + degreeCourse, function(data){
			data.forEach(function(element){
				selectField.append("<option>" + element + "</option>");
			});				
		},"json");			
	});	
}

function handleDescriptionInput(){
	var descriptionInput = $("#description");
	var descriptionTooltip = $("#descriptionTooltip");
	//var default_tooltip = descriptionTooltip.text();

	descriptionInput.focus(function(){
		descriptionTooltip.show("fade",animationTime);
	});

	descriptionInput.blur(function(){
		descriptionTooltip.hide("fade",animationTime);
	});
}

function handleUploadButton(btn){

	$("#uploadForm").change(function(){	
		
		if(isFormCompleted()){
			btn.removeAttr("disabled");
		}
		else
			btn.attr("disabled","disabled");	
	});	
}

function isFormCompleted(){

	if($("#name").val().length > 0 &&
	   $("#name").val().length <= 10 && 
       $("#category").val().length!=0 && 
	   $("#degreeCourse").val().length!=0 && 
	   $("#subject").val().length!=0 &&
	   $("#description").val().length!=0 &&
	   $("#inputFile").val().length!=0 &&  	   	   // if a file is selected
	   $("#inputFile").prop("files")[0].size > 0)  // and it isn't empty
	{
		return true;
	}
	else
		return false;
}