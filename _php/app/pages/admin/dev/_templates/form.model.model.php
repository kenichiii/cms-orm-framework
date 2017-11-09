
<form class="template" method="get" action="<?php echo App::getIns()->setAjaxLink( '_curr', 'model_model' ) ?>">    
    <div style="padding-top: 7px;padding-bottom: 7px;">
    <b>Class:</b> <input type="text" name="class">_Model extends: <input type="text" name="extends" value="Model_Model"> 
    <br>
    Title: <input type="text" name="title"> 
    RawName: <input type="text" name="rawname"> 
    </div>    
  
    <div style="padding-top: 7px;padding-bottom: 7px;">
    <b>Grid Class:</b> <input type="text" name="grid">
        <label for='creategrid'> <input type='checkbox' name='creategrid' id="creategrid" value='1'> create grid</label>
        <div class="hidden" id="creategrid-form">            
            Extends: <input type="text" name="grid_extends" value="Model_Grid"> 
            Title: <input type="text" name="grid_title"> 
            Model: <input type="text" name="grid_model">

            Table: <input type="text" name="grid_table" value=':db:'> Alias: <input type="text" name="grid_alias"> 
            
        </div>
     </div>
     <div>
      <b>Forms: </b>   
        <label for='createformnew'><input type='checkbox' name='createformnew' id="createformnew" value='1'> create form new</label>
        <label for='createformedit'><input type='checkbox' name='createformedit' id="createformedit" value='1'> create form edit</label>
        
        <div class="hidden" id='createformnew-form'>
                <b>F-NEW Class:</b> <input type="text" name="form_new_class"> 
                Extends: <input type="text" name="form_new_extends" value="Model_Form"> 
                Title: <input type="text" name="form_new_title" value="Nový"> 
                Name: <input type="text" name="form_new_name" value="">                 
                Model: <input type="text" name="form_new_model">

                Action: <input type="text" name="form_new_action" value="<?php echo Model_Form::ACTION_NEW ?>">
        </div>            
        
        <div class="hidden" id='createformedit-form'>
                <b>F-EDIT Class:</b> <input type="text" name="form_edit_class"> 
                Extends: <input type="text" name="form_edit_extends" value="Model_Form"> 
                Title: <input type="text" name="form_edit_title" value="Upravit"> 
                Name: <input type="text" name="form_edit_name" value="">                 
                Model: <input type="text" name="form_edit_model">

                Action: <input type="text" name="form_edit_action" value="<?php echo Model_Form::ACTION_EDIT ?>">
        </div>    
      </div>  
    <div  style="padding-top: 7px;padding-bottom: 7px;">
    <h3>Collums:</h3>
    <div>
      <b>Predefined Collums:</b>
      <div>
        <label for="pk"><input type="checkbox" name="children[]" value="id" id="pk"> PkId</label>   
        <label for="nestedindexes"><input type="checkbox" name="children[]" value="nestedindexes" id="nestedindexes"> nix</label>
        <label for="parentId"><input type="checkbox" name="children[]" value="parentId" id="parentId"> parentId</label>
        <label for="ownerId"><input type="checkbox" name="children[]" value="ownerId" id="ownerId"> ownerId</label>
        <b> | </b>
        <label for="rank"><input type="checkbox" name="children[]" value="rank" id="rank"> rank</label>
        <b> | </b>
        <label for="del"><input type="checkbox" name="children[]" value="deleted" id="del"> deleted</label>
        <b> | </b>
        <label for="lang"><input type="checkbox" name="children[]" value="lang" id="lang"> lang</label>
        <b> | </b>
        <label for="date"><input type="checkbox" name="children[]" value="date" id="date"> date</label>
        <b> | </b>
        <label for="trans"><input type="checkbox" name="children[]" value="trans" id="trans"> use Trans</label>
        :
        <label for="ac"><input type="checkbox" name="children[]" value="active" id="ac"> active</label>
        <label for="h1"><input type="checkbox" name="children[]" value="h1" id="h1"> h1</label>
        <label for="uri"><input type="checkbox" name="children[]" value="uri" id="uri"> (unique) uri</label>
        <label for="perex"><input type="checkbox" name="children[]" value="perex" id="perex"> perex</label>
        <label for="chcbxcontent"><input type="checkbox" name="children[]" value="content" id="chcbxcontent"> content</label>        
        <b> | </b>
        <label for="foto"><input type="checkbox" name="children[]" value="foto" id="foto"> photo</label>
        <label for="file"><input type="checkbox" name="children[]" value="file" id="file"> file</label>
        <b> | </b>
        <label for="created"><input type="checkbox" name="children[]" value="created" id="created"> created</label>
        <label for="lastupdate"><input type="checkbox" name="children[]" value="lastupdate" id="lastupdate"> lastUpdate</label>
                
      </div>  
    </div>    
    </div>    
    <b>Custom Collums:</b>
    <div class="collums">
        <ul>
        
        <li class="collum">
            Name: <input type="text" name="collum_name[]"> 
            Class: <input type="text" name="collum_class[]">                         
            Title: <input type="text" name="collum_title[]">
            <br>
             not null: <input type="text" name="collum_notnull[]" class="notnull" style="width:25px" value="0">
             default: <input type="text" name="collum_default[]">                    
             key: <input type="text" name="collum_key[]" class="key" style="width:25px" value="0">
             trans: <input type="text" name="collum_trans[]" class="trans" style="width:25px" value="0">             
             unique: <input type="text" name="collum_unique[]" class="unique" style="width:25px" value="0">
            with <input type="text" name="collum_unique_with[]">       
            
        </li>    
        </ul>
        <div><a class="collum_next" href="#">+ add next collum</a></div>
    </div>    
    
    <div style="padding-bottom: 7px;">
    <h3>Relationships:</h3>
    <div>
      <b>Predefined Models:</b>
      <div>
            <label for="addgallery"><input type="checkbox" name="add_gallery" value="gallery" id='addgallery'> gallery</label>
            <div class='hidden' id='predefined-gallery-form'>
            <b>Gallery: </b>    
          <div>  
            allowed EXTs: <input type="text" style="width:450px" name="gallery_allowed" value="jpg,png,gif"> (allfiles) <br>
            Model: <input type="text" name="gallery_model" value=""> 
            name: <input type="text" name="gallery_model_name" value=""> <br>
            Grid: <input type="text" name="gallery_grid">             
            Dir: <input type="text" name="gallery_dir">                 
            Table: <input type="text" name="gallery_table" value=':db:'> 
            Alias: <input type="text" name="gallery_alias" value=''>
            <br>
            
        &nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;
        <label for='gallery-createformnew'><input type='checkbox' name='gallery_createformnew' id="gallery-createformnew" value='1'> create form new</label>
        <label for='gallery-createformedit'><input type='checkbox' name='gallery_createformedit' id="gallery-createformedit" value='1'> create form edit</label>
        
        <div class="hidden" id='gallery-createformnew-form'>
                <b> - Gallery F-NEW Class:</b> <input type="text" name="gallery_form_new_class"> 
                Extends: <input type="text" name="gallery_form_new_extends" value="Model_Component_Gallery_Form_New"> 
                Title: <input type="text" name="gallery_form_new_title" value="Nový obrázek"> 
                Name: <input type="text" name="gallery_form_new_name" value="">                 
                Model: <input type="text" name="gallery_form_new_model">
                Action: <input type="text" name="gallery_form_new_action" value="<?php echo Model_Form::ACTION_NEW ?>">
        </div>            
        
        <div class="hidden" id='gallery-createformedit-form'>
                <b> - Gallery F-EDIT Class:</b> <input type="text" name="gallery_form_edit_class"> 
                Extends: <input type="text" name="gallery_form_edit_extends" value="Model_Component_Gallery_Form_Edit"> 
                Title: <input type="text" name="gallery_form_edit_title" value="Upravit obrázek"> 
                Name: <input type="text" name="gallery_form_edit_name" value="">                 
                Model: <input type="text" name="gallery_form_edit_model">

                Action: <input type="text" name="gallery_form_edit_action" value="<?php echo Model_Form::ACTION_EDIT ?>">
        </div>  
        </div>  
            
        <br>
        </div><!-- gallery -->

            
            <label for="adddocs"><input id="adddocs" type="checkbox" name="add_docs" value="docs"> docs</label>
        <div class="hidden" id="predefined-docs-form">
            <b>Documents: </b>    
          <div>  
            allowed EXTs: <input type="text" style="width:450px" name="docs_allowed" value="jpg,png,gif,pdf,doc,docx,xls,txt,zip,csv,avi,mp3,mp4"> (allfiles) <br>
            Model: <input type="text" name="docs_model" value=""> 
            name: <input type="text" name="docs_model_name" value=""> <br>
            Grid: <input type="text" name="docs_grid">             
            Dir: <input type="text" name="docs_dir">                 
            Table: <input type="text" name="docs_table" value=':db:'> 
            Alias: <input type="text" name="docs_alias" value=''>
            <br>
            
        &nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;
        <label for='docs-createformnew'><input type='checkbox' name='docs_createformnew' id="docs-createformnew" value='1'> create form new</label>
        <label for='docs-createformedit'><input type='checkbox' name='docs_createformedit' id="docs-createformedit" value='1'> create form edit</label>
        
        <div class="hidden" id='docs-createformnew-form'>
                <b> - Docs F-NEW Class:</b> <input type="text" name="docs_form_new_class"> 
                Extends: <input type="text" name="docs_form_new_extends" value="Model_Component_FilesGrid_Form_New"> 
                Title: <input type="text" name="docs_form_new_title" value="Nový soubor"> 
                Name: <input type="text" name="docs_form_new_name" value="">                 
                Model: <input type="text" name="docs_form_new_model">

                Action: <input type="text" name="docs_form_new_action" value="<?php echo Model_Form::ACTION_NEW ?>">
        </div>            
        
        <div class="hidden" id='docs-createformedit-form'>
                <b> - Docs F-EDIT Class:</b> <input type="text" name="docs_form_edit_class"> 
                Extends: <input type="text" name="docs_form_edit_extends" value="Model_Component_FilesGrid_Form_Edit"> 
                Title: <input type="text" name="docs_form_edit_title" value="Upravit soubor"> 
                Name: <input type="text" name="docs_form_edit_name" value="">                 
                Model: <input type="text" name="docs_form_edit_model">

                Action: <input type="text" name="docs_form_edit_action" value="<?php echo Model_Form::ACTION_EDIT ?>">
        </div>  
        </div>    
        <br>
        </div><!-- docs -->
            
            
            
            
            
            <label for="gallery"><input type="checkbox" name="rel_children[]" value="tagy"> tags</label>
            <label for="gallery"><input type="checkbox" name="rel_children[]" value="diskuse"> discusion</label>
            <label for="gallery"><input type="checkbox" name="rel_children[]" value="pgallery"> private gallery</label>
            <label for="gallery"><input type="checkbox" name="rel_children[]" value="pdocs"> private docs</label>          
      </div>    
    </div>      
    </div>    
    <b>Custom Models:</b>
    <div class="rels">
        <ul>
        <li class="rel">

            Title: <input type="text" name="rel_title[]"> Name: <input type="text" name="rel_name[]"> 
            Class: <input type="text" name="rel_class[]"> 
            <br>Rel: <select name="rel_rel[]">
                    <option value="join">is left join</option>
                    <option value="N1">model has many</option>
                    <option value="11">model has one</option>
                    <option value="NN">many model has many</option>
                 </select>
            this on <input type="text" name="rel_from[]"> model from  <input type="text" name="rel_to[]">
        </li>    
        </ul>
        <div class=""><a class="rel_next" href="#">+ add next rel</a></div>
    </div>
    <br>
    <div class="submit fleft">
        <input type="submit" value="Generate model">
    </div>
</form>   
    <div class="submit fleft">
        <button class="model-reset">Reset</button>
    </div>
    <br class="clear">
    <br>