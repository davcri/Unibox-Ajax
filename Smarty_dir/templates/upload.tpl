
{if $loggedIn}
  <div id="uploadForm" class="jumbotron">
    <p class="lead">Da questa pagina puoi inviarci i tuoi file.</p>
    <p>Ti basta compilare la form qui sotto</p> <br>

    <form name="uploadForm" method="POST" enctype="multipart/form-data" action="index.php?controllerAction=upload">
      <div class="form-group">
        <label>Nome risorsa</label>
        <input type="text" class="form-control" id="name" placeholder="Nome risorsa">
      </div>

      <div class="form-group">
        <label>Categoria</label>
        <select id="category" class="form-control" name="category">
          <option value="teoria">Teoria</option>
          <option value="esercizi">Esercizi</option>
          <option value="laboratorio">Laboratorio</option>
        </select>
      </div>

      <div class="form-group">
        <label>Corso di laurea</label>
        <select id="degreeCourse" class="form-control" name="degreeCourse">
          <option value=""></option>
          {foreach $degreeCourses as $opt}
            <option value="{$opt->getName()}">{$opt->getName()}</option>
          {/foreach}
        </select>
      </div>

      <div class="form-group">
        <label>Materia</label>
        <select id="subject" class="form-control" name="subject">
            <option value=""></option>
        </select>
       <!--  <input type="text" class="form-control" id="subject" placeholder="Materia"> -->
      </div>

      <div class="form-group">
        <p class="help-block">Seleziona il file da caricare</p>
        <label>File input</label>
        <div id="fileuploader">Upload</div>
        <!-- <input type="file" id="inputFile"> -->
      </div>

      <button id="uploadButton"  class="btn btn-primary">Invia</button>
    </form>
  </div>
{else}
  <div id="loginRequired" class="alert alert-danger text-center">Devi registrarti o effettuare il login per caricare file.</div>
{/if}

  
<script src="Smarty_dir/templates/javascript/jquery.uploadfile.min.js"></script>
<script src="Smarty_dir/templates/javascript/upload.js"></script>
<link href="Smarty_dir/templates/css/uploadfile.min.css" rel="stylesheet">
