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
            <?php if($gallery = $formedit->getModel()->isGalleryAble()) { ?><a href='#<?php echo $formedit->getName(); ?>-tab-gallery'><?php echo $gallery->getGrid()->getTitle() ?></a><?php } ?>        
            <?php if($docs = $formedit->getModel()->isDocsAble()) { ?><a href='#<?php echo $formedit->getName(); ?>-tab-docs'><?php echo $docs->getGrid()->getTitle() ?></a><?php } ?>        
            <br class="clear">
        </div>   
        <div class='tabs-bodies'>
            
   <div id='<?php echo $formedit->getName(); ?>-tab-edit' class='tab'>
        <h3>Základní údaje</h3>         
                        
     <?php } //end tabs ?>   
      
    <div style="float:right;padding-right:45px;padding-top: 10px">      
     <?php if($photo=$formedit->getModel()->isPhotoAble()) { ?>   
        <div style="padding-bottom: 15px;"> 
            <div style="padding-bottom: 5px;"><h3><?php echo $photo->getTitle(); ?></h3></div>  
            [[ require '_templates/form.<?php echo $formedit->getModel()->getModelName(); ?>.<?php echo $photo->getCollum(); ?>.file.form.holder.php'; ]]              
        </div>    
     <?php } ?>
     <?php if($file=$formedit->getModel()->isFileAble()) { ?>   
        <div style="padding-bottom: 15px;"> 
            <div style="padding-bottom: 5px;"><h3><?php echo $photo->getTitle(); ?></h3></div>  
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
        <form id="<?php echo $formedit->getName() ?>" action="[[ echo App::getIns()->setActionLink('_curr','<?php echo $model->getHtmlID(); ?>-edit') ]]" method="<?php echo $formedit->getMethod() ?>">                        
        
        <div class='error hidden'>Při ukládání došlo k chybám ve validaci, prosím opravte si svoje údaje.</div>    
        
        <?php foreach($formedit->getModel()->getModel() as $key=>$child) { ?>
            <?php if($child->isPrimitive()&&$child->isPrimaryKey()) { ?>
            <input type="hidden" name="<?php echo $child->getCollum() ?>" value="[[ echo $bean->get('<?php echo $child->getCollum() ?>')->getValue() ]]">
            <?php } ?>
        <?php } ?>
        
        
        <?php foreach($formedit->getModel()->getModel() as $key=>$child) { 
                if($child->isMixed()) printMixed2 ($child,$formedit);
                elseif($child->isDefault()&&$child instanceof Model_Default_Content)
                {
                    //continue;
                }
                elseif($child->isPrimitive()&&$key!='deleted'&&$key!='lastupdate'&&!$child instanceof Model_Primitive_Timestamp&&!$child->isPrimaryKey())
                    echo $child->getTemplate('form/edit','template',$formedit);                             
               } ?>    
                                     
            
            <div class="model-form-submit">
                <input type="submit" value="Uložit">
            </div>    
                        
        </form>    
        
       </div>  
       <br class="clear">
        
       
 <?php if($useTabs) { ?>   
       
       </div> <!-- tab basic -->
       
       
       <?php if($content = $formedit->getModel()->isContentAble()) { ?>             
            <div id='<?php echo $formedit->getName(); ?>-tab-content' class='tab'>
                <h3><?php echo $content->getTitle(); ?></h3>
               <div class="model-form-holder"> 
                <form id="<?php echo $formedit->getName(); ?>-contentForm" action="[[ echo App::getIns()->setActionLink('_curr', '<?php echo $model->getHtmlID(); ?>-edit-content') ]]" method="post">                       
                    <div class="row-<?php echo $content->getCollum() ?>">
                            <input type="hidden" name="id" value="[[ echo $bean->getId()->getValue() ]]">                        
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
               [[ require '_templates/<?php echo $formedit->getModel()->getGrid()->getName(); ?>_gallery.holder.php' ]]
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
