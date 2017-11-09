
<?php

$ownerId = $grid->getModel()->isOwnerIdAble();
$parentId = $grid->getModel()->isParentIdAble();
$rank = $grid->getModel()->isRankAble();
$active = $grid->getModel()->isActiveAble();
$photo = $grid->getModel()->isPhotoAble();
$h1 = $grid->getModel()->isH1Able();
$uri = $grid->getModel()->isUriAble();
$date = $grid->getModel()->isDateAble();
$perex = $grid->getModel()->isPerexAble();
$content = $grid->getModel()->isContentAble();
$created = $grid->getModel()->isCreatedAble();
$lastupdate = $grid->getModel()->isLastupdateAble();


?>


    <div class="<?php echo $grid->getName(); ?>-holder">
        
        <input type="hidden" name="list" value="[[ echo App::getIns()->setAjaxLink('_curr','<?php echo $grid->getName(); ?>-list'); ]]">
        <input type="hidden" name="edit-action" value="[[ echo App::getIns()->setAjaxLink('_curr','<?php echo $grid->getName(); ?>-edit'); ]]">
        
        <input type="hidden" name="action-add-action" value="[[ echo App::getIns()->setActionLink('_curr','<?php echo $grid->getName(); ?>-add'); ]]">
        <input type="hidden" name="action-edit-action" value="[[ echo App::getIns()->setActionLink('_curr','<?php echo $grid->getName(); ?>-edit'); ]]">
        <input type="hidden" name="action-delete-action" value="[[ echo App::getIns()->setActionLink('_curr','<?php echo $grid->getName(); ?>-delete'); ]]">
        <?php if($rank) { ?>
        <input type="hidden" name="action-sort-action" value="[[ echo App::getIns()->setActionLink('_curr','<?php echo $grid->getName(); ?>-sort'); ]]">
        <?php } ?>
                                       
        
            <input type="hidden" name="allowed" value="[[ echo implode(',', $bean->getDocs()->getAllowedExt()) ]]">
    
            
            
    <h3><?php echo $grid->getTitle(); ?></h3>        
    <div class="button-holder">
        <a href="#" class="button-link button">Vyberte soubory k nahrání</a> <input name="upload" type="file" multiple>
    </div>

    <div class="form-holder hidden">
       <?php if($grid->getModel()->isLangAble()) { ?>
        <div class="langHolder">
            Jazyk: <select name="lang"><?php foreach (Project::$languages as $key => $value) {?><option value="<?php echo $value; ?>"><?php echo $value; ?></option><?php } ?></select>
        </div>    
        <?php } ?>
   
          
        <?php if($parentId) { ?>
        <input type="hidden" name="parentid" value="[[ echo isset($bean)?$bean->get('<?php echo $grid->getModel()->getPrimaryKey()->getCollum(); ?>')->getValue():0; ]]">
        <?php } ?>
        <?php if($ownerId) { ?>
        <input type="hidden" name="ownerid" value="[[ echo $bean->get('<?php echo $grid->getModel()->getPrimaryKey()->getCollum(); ?>')->getValue(); ]]">
        <?php } ?>
    </div>    
    
    
    
    <div class="template hidden">        
      <div class="file-upload-preview" style="float:left;width:300px;margin-bottom: 10px;">  
          <div class="icon" style="float:left;width:80px;height:80px;text-align: center;font-size: 1.6em;"></div>
          <div class="body" style="float:left;width:200px;padding-left: 15px;">
            <div class="info" style="padding-bottom: 6px">
                <b>Soubor:</b> <span class="name"></span><br>
                <b>Velikost:</b> <span class="filesize"></span><br>
                <b>Typ:</b> <span class="type"></span><br>
            </div>  
            <div class="error-container" style="float: left;display: block;	width: 190px;padding: 2px 5px;margin: 2px 0">  
            </div>  
          </div>    
      </div> 
    </div>    

    <div class="hidden progress-holder-holder"> 
       <div class="progress-holder" style="width:610px;float:left;margin-bottom: 15px;"> 
           <b>Průběh nahrávání:</b>
            <div class="progress-bar-container" style="float: left;display: block;	width: 590px;padding: 2px 5px;margin: 2px 0;border: 1px inset #446;border-radius: 5px;">  
                <div class="progress-bar" style="background: #0c0 none 0 0 no-repeat;min-height: 20px;">
                </div>
            </div>  
       </div>    
     </div>   
        
    <output style="width:610px;float:left;"></output>
        
    <br class="clear">
    
   ´                
        

        <div class="list-holder">
            Nahrávám data...
        </div>    
        
      </div>   <!-- <?php echo $grid->getName(); ?>-holder  -->     

      <br class="clear">
      
      