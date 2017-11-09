
<div class='component-gallery-admin' id="reference_gallery">
    <h3>Galerie</h3>

   <input id="reference-gallery-list-url" type="hidden" value="<?php echo App::getIns()->setAjaxLink('_curr','reference-gallery'); ?>">
   <input id="reference-gallery-sort-url" type="hidden" value="<?php echo App::getIns()->setActionLink('_curr' ,'reference-gallery-sort'); ?>">
   <input id="reference-gallery-delete-url" type="hidden" value="<?php echo App::getIns()->setActionLink('_curr','reference-gallery-delete'); ?>">    
   <input type="hidden" id="reference-gallery-ownerid" value="<?php echo $bean->getId()->getValue() ?>">  
   <input type="hidden" id="reference-gallery-upload-url" value="<?php echo App::getIns()->setActionLink('_curr','reference-gallery-upload') ?>"> 

   <form id="reference_gallery_form" enctype="multipart/form-data" method="post" action="<?php echo App::getIns()->setActionLink('_curr','reference-gallery-upload'); ?>?id=<?php echo $bean->getId()->getValue(); ?>">

<p>
<a href="#" id="reference-gallery-button-upload" class="button-link">Vyberte soubory k nahrání</a> <input id="reference-gallery-files-upload" type="file" multiple>
</p>

 <br>
<output id="reference-gallery-file-list"></output>
<br class='clear'>

   </form>     
   <b>Nahrané obrázky:</b>
   <div class="gallery-admin-holder"> 
    <?php require_once '_ajax/reference-gallery.php'; ?>
   </div> 
</div>   
   