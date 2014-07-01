    <div id="UploadFormContent">
        <form name="formRegister" method="POST" enctype="multipart/form-data" action="index.php?controllerAction=upload">
            <table>
                <tr>
                    <td>Name: </td>
                    <td><input name="name" type="text"/></td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                                <option value="teoria">Teoria</option>
                                <option value="esercizi">Esercizi</option>
                                <option value="laboratorio">Laboratorio</option>
                            
                        </select>
                    </td>
                </tr>
				<tr>
                    <td>DegreeCourse: </td>
                    <td>
                    	<select name="degreeCourse">
	                    	{foreach $degreeCourses as $opt}
	                    		<option value="{$opt->getName()}">{$opt->getName()}</option>
	                    	{/foreach}
                    	</select>
                    </td>
                    <!--<input name="degreeCourse" type="text"/></td>-->
                </tr>
                <tr>
                    <td>Subject: </td>
              		<td><input name="subject" type="text"/></td>
                </tr> 
                <tr>
                    <td>File to upload: </td>
                     <!-- MAX_FILE_SIZE (measured in bytes) must precede the file input field -->
    				 <!-- <input type="hidden" name="MAX_FILE_SIZE" value="128000000" /> --> 
                     <!-- probabilmente faremo questo controllo con javascript, per il momento commento --> 
                    <td><input name="uploadedFile" type="file"/></td>
                </tr>
                <tr>
                    <td></td>
                    <td><button type="submit" class="button">Upload Resource</button> </td>
                </tr>
            </table>        
        </form>
    </div>
