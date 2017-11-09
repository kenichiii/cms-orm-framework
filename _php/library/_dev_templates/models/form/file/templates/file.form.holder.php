

<div class='file-upload-form-holder' id="<?php echo $model->getModelName().'_file_'.$collum; ?>">

    <input type="hidden" name='file-ajax-url' value="[[ echo App::getIns()->setAjaxLink('_curr','<?php echo $model->getModelName().'-'; ?><?php echo $collum; ?>-file'); ]]?id=[[ echo $bean->getId()->getValue(); ]]">
    <input type="hidden" name='file-action-url' value="[[ echo App::getIns()->setActionLink('_curr','<?php echo $model->getModelName().'-'; ?><?php echo $collum; ?>-file-upload'); ]]?id=[[ echo $bean->getId()->getValue(); ]]">
    
    <input type="hidden" name="id" value="[[ echo $bean->getId()->getValue(); ]]">
    
    <input type="hidden" name="allowed" value="[[ echo implode(',', $bean->get('<?php echo $collum ?>')->getAllowedExt()) ]]">
    
    <div class="button-holder">
        <a href="#" class="button-link button">Vyberte soubor k nahrání</a> <input name="upload" type="file">
    </div>
    <br>
    <div class="template hidden">        
      <div class="file-upload-preview" style="float:left;width:300px">  
          <div class="icon" style="float:left;width:80px;height:80px;text-align: center;font-size: 1.6em;"></div>
          <div class="body" style="float:left;width:200px;padding-left: 15px;">
            <div class="info" style="padding-bottom: 6px">
                <b>Soubor:</b> <span class="name"></span><br>
                <b>Velikost:</b> <span class="filesize"></span><br>
                <b>Typ:</b> <span class="type"></span><br>
            </div>  
            <div class="progress-bar-container" style="float: left;display: block;	width: 190px;padding: 2px 5px;margin: 2px 0;border: 1px inset #446;border-radius: 5px;">  
                <div class="progress-bar" style="background: #0c0 none 0 0 no-repeat;min-height: 16px;">
                </div>
            </div>  
          </div>    
      </div> 
    </div>    
    <output style="width:300px;float:left;"></output>
        
    <br class="clear">
    
    <div class="preview"></div>
    
</div> <!-- end file upload form -->    


