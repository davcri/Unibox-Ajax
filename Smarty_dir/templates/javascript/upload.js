// TODO metti le variabili dentro un JSON

$(function(){

	/* If you want to change these values, remember to change also the values in Control/Upload.php */
	var maxNameChars = 30;
	var maxDescriptionChars = 150;

	var uploadButton = $("#uploadButton");

	$(".myTooltip").hide(); // hide all tooltips div
	
	handleNameInput(uploadButton, maxNameChars, maxDescriptionChars);
	handleSubjectInput();
	handleDescriptionInput(uploadButton, maxNameChars, maxDescriptionChars); 
	handleUploadInput(uploadButton, maxNameChars, maxDescriptionChars);

	handleUploadButton(uploadButton, maxNameChars, maxDescriptionChars);	
});

function handleNameInput(uploadBtn, maxNameChars, maxDescriptionChars)
{
	var nameInput = $("#name");
	var nameTooltip = $("#nameTooltip");
	var default_nameTooltip = nameTooltip.text();

	nameInput.focus(function(){
		nameTooltip.show("fade",animationTime);
	});

	nameInput.blur(function(){
		nameTooltip.hide("fade",animationTime);
	});

	nameInput.keyup(function(){	// validation function
		if($(this).val().length==0){
			$(this).parent().addClass("has-error");
			uploadBtn.attr("disabled","disabled");
			nameTooltip.text("Il nome non può essere vuoto").show("fade",animationTime);
		}
		else if($(this).val().length > maxNameChars){
			$(this).parent().addClass("has-error");
			uploadBtn.attr("disabled","disabled");
			nameTooltip.text("Il nome non può contenere più di " + maxNameChars + " caratteri").show("fade",animationTime);
		}
		else{
			// nameTooltip.parent().addClass("has-success has-feedback");
			if(isFormCompleted(maxNameChars, maxDescriptionChars))
				uploadBtn.removeAttr("disabled");

			if($(this).parent().hasClass("has-error"))
			{
				$(this).parent().removeClass("has-error");
				nameTooltip.text(default_nameTooltip);						
			}			
		}		
	});
}

function handleSubjectInput(){
	var selectField = $("#subject");

	$("#degreeCourse").change(function(){
		var degreeCourse = $(this).val();
		selectField.empty(); // remove all previous loaded subjects
		
		$.get("index.php?controllerAction=upload&uploadAction=updateSubjectsField&degreeCourse=" + degreeCourse, function(data){
			data.forEach(function(element){
				selectField.append("<option>" + element + "</option>");
			});				
		},"json");			
	});	
}

function handleDescriptionInput(uploadBtn, maxNameChars, maxDescriptionChars){
	var descriptionInput = $("#description");
	var descriptionTooltip = $("#descriptionTooltip");
	var default_DescriptionTooltip = descriptionTooltip.text();

	descriptionInput.focus(function(){
		descriptionTooltip.show("fade",animationTime);
	});

	descriptionInput.blur(function(){
		descriptionTooltip.hide("fade",animationTime);
	});

	descriptionInput.keyup(function(){
		if($(this).val().length==0){
			$(this).parent().addClass("has-error");
			uploadBtn.attr("disabled","disabled");
			descriptionTooltip.text("Inserisci una descrizione").show("fade",animationTime);
		}
		else if($(this).val().length > maxDescriptionChars){
			$(this).parent().addClass("has-error");
			uploadBtn.attr("disabled","disabled");
			descriptionTooltip.text("La descrizione non può contenere più di " + maxDescriptionChars + " caratteri").show("fade",animationTime);
		}
		else{
			if(isFormCompleted(maxNameChars, maxDescriptionChars))
				uploadBtn.removeAttr("disabled");

			if($(this).parent().hasClass("has-error"))
			{
				$(this).parent().removeClass("has-error");
				descriptionTooltip.text(default_DescriptionTooltip);						
			}			
		}
	});
}

function handleUploadInput(btn, maxNameChars, maxDescriptionChars){ 
	$("#inputFile").change(function(){
		var maxFileSize = $("#maxFileSize").text(); // get the max file size in Mega Bytes
		maxFileSize = parseInt(maxFileSize); 

		var uploadedFileSize = $("#inputFile").prop("files")[0].size;
		uploadedFileSize = uploadedFileSize/(1000*1000); // uploadedFileSize in Mega Bytes

		if(uploadedFileSize > maxFileSize)
		{
			$.growlUI('Errore', 'File troppo grande'); 
		}
	})
}

function handleUploadButton(btn, maxNameChars, maxDescriptionChars){

	//$("#progressBar").hide();

	$("#uploadForm").change(function(){			
		if(isFormCompleted(maxNameChars, maxDescriptionChars)){
			btn.removeAttr("disabled");
		}
		else
			btn.attr("disabled","disabled");	
	});	

	$("#uploadForm").submit(function(event) {
		event.preventDefault();	

		var formData = new FormData(this);

		// for details and explanation read: http://stackoverflow.com/questions/5392344/sending-multipart-formdata-with-jquery-ajax 
		// processData and contentType need to be false, otherwise the ajax call will fail.
		$.ajax({
			url: 'index.php?controllerAction=upload&uploadAction=uploadResource',
			type: 'POST',
			data: formData,
			processData: false,
			contentType: false,
			xhr: function(){
		        // get the native XmlHttpRequest object
		        var xhr = $.ajaxSettings.xhr() ;
		        
		        xhr.upload.onprogress = function(evt){
		        	var currentProgress = evt.loaded/evt.total*100; 
		        	console.log(currentProgress);
		        	$("#progressBar").css({"width": currentProgress+"%"});
		        	$("#progressBar").text(Math.floor(currentProgress)+"%");
		        	} ;
		        
		        // upload completed
		        xhr.upload.onload = function(){ console.log('DONE!'); } ;
		      
		        return xhr;
		    }
		})
		.done(function(data){
			setTimeout(function(){ // delay the change page to smooth the navigation
				changePage(data);
			}, 500);
		});
	});
}

function isFormCompleted(maxNameChars, maxDescriptionChars){

	var maxFileSize = $("#maxFileSize").text(); // get the max file size in Mega Bytes
	maxFileSize = parseInt(maxFileSize); 
	
	if($("#inputFile").prop("files").length==0) // if no file is selected
		var uploadedFileSize=0;
	else
	{
		var uploadedFileSize = $("#inputFile").prop("files")[0].size;
		uploadedFileSize = uploadedFileSize/(1000*1000); // uploadedFileSize in Mega Bytes	
	}


	

	if($("#name").val().length > 0 &&
	   $("#name").val().length <= maxNameChars && 
       $("#category").val().length!=0 && 
	   $("#degreeCourse").val().length!=0 && 
	   $("#subject").val().length!=0 &&
	   $("#description").val().length!=0 &&
	   $("#description").val().length <= maxDescriptionChars &&
	   $("#inputFile").val().length!=0 && // if a file is selected
	   uploadedFileSize > 0 && // and it isn't empty
	   uploadedFileSize < maxFileSize)  
	{
		return true;
	}
	else
		return false;
}

