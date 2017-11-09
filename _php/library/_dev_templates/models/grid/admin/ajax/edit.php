[[
    
   $id = $_GET['id'];

    if(is_numeric($id))
    {
        
        $bean  = <?php echo $formedit->getModelClass() ?>::loadByPK($id);
                        
        if($bean instanceof <?php echo $formedit->getModelClass() ?>) 
        {
        
            //
        
        }
        else $notFoundedId = true;
    }
    else $notFoundedId = true;
    
]]


        [[ if(isset($notFoundedId)&&$notFoundedId) { ]]
    
        <h1>Neplatné ID</h1>
        
        [[ } else { ]]

        
     <?php if($useTabs) { ?>   
      <div class='tabs-holder' id="<?php echo $formedit->getName(); ?>-edit-dialog-tabs">
        <div class='tabs-head'>
            <a href='#<?php echo $formedit->getName(); ?>-tab-edit'>Základní informace</a>
            <?php if($content = $formedit->getModel()->isContentAble()) { ?><a href='#<?php echo $formedit->getName(); ?>-tab-content'><?php echo $content->getTitle(); ?></a><?php } ?>            
            <?php if($gallery = $formedit->getModel()->isGalleryAble()) { ?><a href='#<?php echo $formedit->getName(); ?>-tab-gallery'><?php echo $gallery->getGrid()->getName(); ?></a><?php } ?>        
            <?php if($docs = $formedit->getModel()->isDocsAble()) { ?><a href='#<?php echo $formedit->getName(); ?>-tab-gallery'><?php echo $docs->getGrid()->getName(); ?></a><?php } ?>        
            <br class="clear">
        </div>   
        <div class='tabs-bodies'>
            
   <div id='<?php echo $formedit->getName(); ?>-tab-edit' class='tab'>
        <h3>Základní údaje</h3>         
                        
     <?php } //end tabs ?>   
      
       <div id="<?php echo $formedit->getName() ?>-holder">  
        
                        <?php if($photo=$formedit->getModel()->isPhotoAble()) { ?>
                        <div style='padding-bottom: 6px;' class="filename"><b>Hlavní obrázek: </b> <span class="mainphoto">[[ echo  $bean->get('<?php echo $photo->getCollum(); ?>')->getValue()!='' ? Project::$WEB_URL . '/' . $bean->get('<?php echo $photo->getCollum(); ?>')->getDir(). '/'. $bean->get('<?php echo $photo->getCollum(); ?>')->getValue() : '---'; ]]</span></div>
                        <?php } ?>
        
                        <?php if($file=$formedit->getModel()->isFileAble()) { ?>
                        <div style='padding-bottom: 6px;' class="filename"><b>Hlavní soubor: </b> <span class="mainfile">[[ echo $bean->get('<?php echo $file->getCollum(); ?>')->getValue()!='' ? Project::$WEB_URL . '/' . $bean->get('<?php echo $file->getCollum(); ?>')->getDir(). '/'. $bean->get('<?php echo $file->getCollum(); ?>')->getValue() : '---'; ]]</span></div>
                        <?php } ?>

                
        
    <div style="float:right;padding-right:25px;padding-top: 10px;overflow-x: hidden;width:330px;">      
     <?php if($photo=$formedit->getModel()->isPhotoAble()) { ?>   
        <div style="padding-bottom: 15px;"> 
            <div style="padding-bottom: 5px;"><h3><?php echo $photo->getTitle(); ?></h3></div>  
            [[ require '_templates/form.<?php echo $formedit->getModel()->getModelName(); ?>.<?php echo $photo->getCollum(); ?>.file.form.holder.php'; ]]              
        </div>    
     <?php } ?>
     <?php if($file=$formedit->getModel()->isFileAble()) { ?>   
        <div style="padding-bottom: 15px;"> 
            <div style="padding-bottom: 5px;"><h3><?php echo $file->getTitle(); ?></h3></div>  
            [[ require '_templates/form.<?php echo $formedit->getModel()->getModelName(); ?>.<?php echo $file->getCollum(); ?>.file.form.holder.php'; ]]              
        </div>    
     <?php } ?>        
       <?php foreach($formedit->getModel()->getCollumsInArray()as$cname=>$ccoll) { 
                if($formedit->getModel()->get($cname) instanceof Model_Extended_File && !$formedit->getModel()->get($cname)->isDefault()) {
           ?>                   
        <div style="padding-bottom: 15px;"> 
            <div style="padding-bottom: 5px;"><h3><?php echo $formedit->getModel()->get($cname)->getTitle(); ?></h3></div>  
            [[ require '_templates/form.<?php echo $formedit->getModel()->getModelName(); ?>.<?php echo $formedit->getModel()->get($cname)->getCollum(); ?>.file.form.holder.php'; ]]              
        </div>    
       <?php }} ?>                           
     </div> <!-- files upload form -->  
        
        
      <div class="model-form-holder">
        <form id="<?php echo $formedit->getName() ?>" action="[[ echo App::getIns()->setActionLink('_curr','<?php echo $grid->getName(); ?>-edit') ]]" method="<?php echo $formedit->getMethod() ?>">                        
        
        <div class='error hidden'>Při ukládání došlo k chybám ve validaci, prosím opravte si svoje údaje.</div>    
        
        
            <input type="hidden" name="[[ echo $bean->getPrimaryKey()->getCollum() ]]" value="[[ echo $bean->getPrimaryKey()->getValue() ]]">
        
        
        <?php foreach($formedit->getModel()->getModel() as $key=>$child) { 
                if($child->isMixed()) printMixed2 ($child,$formedit);
                elseif($child->isDefault()&&$child instanceof Model_Default_Content)
                {
                    //continue;
                }
                elseif($child->isPrimitive()&&$key!='deleted'&&$key!='ownerid'&&$key!='parentid'&&$key!='lastupdate'&&!$child instanceof Modela_Primitive_Timestamp&&!$child->isPrimaryKey())
                    echo $child->getTemplate('form/edit','template',$formedit);                             
               } ?>    
                                     
            
            <div class="model-form-submit">
                <input type="submit" value="Uložit">
            </div>    
                        
        </form>    
        
       </div>  
       <br class="clear">
        
       </div> <!-- form holder -->
       
 <?php if($useTabs) { ?>   
       
       </div> <!-- tab basic -->
       
       
       <?php if($content = $formedit->getModel()->isContentAble()) { ?>             
            <div id='<?php echo $formedit->getName(); ?>-tab-content' class='tab'>
                <h3><?php echo $content->getTitle(); ?></h3>
               <div class="model-form-holder"> 
                <form id="<?php echo $formedit->getName(); ?>-contentForm" action="[[ echo App::getIns()->setActionLink('_curr', '<?php echo $grid->getName(); ?>-edit-content') ]]" method="post">                       
                    <div class="row-<?php echo $content->getCollum() ?> err-<?php echo $content->getCollum(); ?>">
                            <input type="hidden" name="[[ echo $bean->getPrimaryKey()->getCollum() ]]" value="[[ echo $bean->getPrimaryKey()->getValue() ]]">                        
                            <textarea class="tinymce" name="<?php echo $content->getCollum(); ?>">[[ echo $bean->get('<?php echo $content->getCollum(); ?>')->getValue(); ]]</textarea>            
                    </div>
                     <br>            
                     <div class="model-form-submit">
                         <input type="submit" value="Uložit">
                     </div>
                 </form>  
                </div>     
             </div>            
       <?php } ?>
              
       <?php if($formedit->getModel()->isGalleryAble()) { ?>             
            <div id='<?php echo $formedit->getName(); ?>-tab-gallery' class='tab'>
               uncomment _pjs/datatable.prototype.bindeditActions /* GALLERY TAB */ <br>
               < ?php require '_templates/<?php echo $formedit->getModel()->getModelName(); ?>.gallery.holder.php' ?>     
            </div>    
       <?php } ?>
 
      <?php if($formedit->getModel()->isDocsAble()) { ?>             
            <div id='<?php echo $formedit->getName(); ?>-tab-docs' class='tab'>
               [[ require '_templates/<?php echo $formedit->getModel()->getGrid()->getName(); ?>_docs.holder.php' ]]     
            </div>    
       <?php } ?>     
       
       
       </div> <!-- tabs bodies -->                        
     </div>   <!-- tabs holder -->       
       
       
       
       
       
       
       
       
 <?php } //end tabs ?>      
       
       
       
       
       
       
 
         
      [[ } ]]      
