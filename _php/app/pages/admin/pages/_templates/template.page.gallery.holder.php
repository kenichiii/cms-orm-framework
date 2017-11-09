<div class='component-gallery-admin' id="page_gallery">
    <h3>Galerie</h3>
    
   <input id="page-gallery-list-url" type="hidden" value="<?php echo App::getIns()->setAjaxLink('_curr','page-gallery'); ?>">
   <input id="page-gallery-sort-url" type="hidden" value="<?php echo App::getIns()->setActionLink('_curr' ,'page-gallery-sort'); ?>">
   <input id="page-gallery-delete-url" type="hidden" value="<?php echo App::getIns()->setActionLink('_curr','page-gallery-delete'); ?>">    
   <input type="hidden" id="page-gallery-ownerid" value="<?php echo $bean->getId()->getValue() ?>">  
   <input type="hidden" id="page-gallery-upload-url" value="<?php echo App::getIns()->setActionLink('_curr','page-gallery-upload') ?>"> 
     
   <form id="page_gallery_form" enctype="multipart/form-data" method="post" action="<?php echo App::getIns()->setActionLink('_curr','page-gallery-upload'); ?>?id=<?php echo $bean->getId()->getValue(); ?>">

<p>
<a href="#" id="page-gallery-button-upload" class="button-link">Vyberte soubory k nahrání</a> <input id="page-gallery-files-upload" type="file" multiple>
</p>

 <br>
<output id="page-gallery-file-list"></output>
<br class='clear'>

   </form>     
   <b>Nahrané obrázky:</b>
   <div class="gallery-admin-holder"> 
    <?php require_once '_ajax/page-gallery.php'; ?>
   </div> 
</div>   
   