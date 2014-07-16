
{if $loggedIn}
  <div class="mainContent">

    <br>
    <p class="lead">Da questa pagina puoi inviarci i tuoi file.</p>
    <p>Ti basta compilare la form qui sotto. <br>
       Nota: È necessario riempire tutti i campi per caricare il file.</p> <br>

    
    <!--  <form id="uploadForm" method="POST" enctype="multipart/form-data" action="index.php?controllerAction=upload"> -->
    <form id="uploadForm">
      <div class="row">
        <div class="col-md-6">
            <div class="form-group">
              <label>Nome risorsa</label>
              <input type="text" class="form-control" id="name" placeholder="Nome risorsa" name="name">
            </div>
        </div>
        
        <div id="nameTooltip" class="col-md-6 myTooltip">
            Inserisci un nome significativo per la risorsa che stai caricando.
        </div>
      </div>    

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Categoria</label>
            <select id="category" class="form-control" name="category">
              <option value="teoria">Teoria</option>
              <option value="esercizi">Esercizi</option>
              <option value="laboratorio">Laboratorio</option>
            </select>
          </div>
        </div>
        <div class="col-md-6 myTooltip">
            tooltip placeholder
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Corso di laurea</label>
            <select id="degreeCourse" class="form-control" name="degreeCourse">
              <option value=""></option>
              {foreach $degreeCourses as $opt}
              <option value="{$opt->getName()}">{$opt->getName()}</option>
              {/foreach}
            </select>
          </div>
        </div>
        <div class="col-md-6 myTooltip">
            tooltip placeholder
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Materia</label>
            <select id="subject" class="form-control" name="subject">
              <option value=""></option>
            </select>
          </div>
        </div>
        <div class="col-md-6 myTooltip">
            tooltip placeholder
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Descrizione</label>
              <textarea class="form-control" rows="3" id="description" placeholder="Breve descrizione" name="description"></textarea>
          </div>
        </div>
        
        <div id="descriptionTooltip" class="col-md-6 myTooltip">
            Inserisci una breve descrizione.
        </div>
      </div> 

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <p class="help-block">Seleziona il file da caricare</p>
            <label>File input</label>
            <input type="file" id="inputFile" name="uploadedFile">
          </div>

          <button id="uploadButton"  class="btn btn-primary" disabled="disabled">Invia</button>
        </div>

        <div class="col-md-6 myTooltip">
          tooltip placeholder
        </div>
      </div>

    </form>
  </div>
{else}
  <div id="loginRequired" class="alert alert-danger text-center">Devi registrarti o effettuare il login per caricare file.</div>
{/if}

<script src="Smarty_dir/templates/javascript/upload.js"></script>
