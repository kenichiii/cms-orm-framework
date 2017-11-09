
<div class='component-gallery-admin' id="news_gallery">
    <h3>Galerie</h3>

   <input id="news-gallery-list-url" type="hidden" value="<?php echo App::getIns()->setAjaxLink('_curr','news-gallery'); ?>">
   <input id="news-gallery-sort-url" type="hidden" value="<?php echo App::getIns()->setActionLink('_curr' ,'news-gallery-sort'); ?>">
   <input id="news-gallery-delete-url" type="hidden" value="<?php echo App::getIns()->setActionLink('_curr','news-gallery-delete'); ?>">    
   <input type="hidden" id="news-gallery-ownerid" value="<?php echo $bean->getId()->getValue() ?>">  
   <input type="hidden" id="news-gallery-upload-url" value="<?php echo App::getIns()->setActionLink('_curr','news-gallery-upload') ?>"> 

   <form id="news_gallery_form" enctype="multipart/form-data" method="post" action="<?php echo App::getIns()->setActionLink('_curr','news-gallery-upload'); ?>?id=<?php echo $bean->getId()->getValue(); ?>">

<p>
<a href="#" id="news-gallery-button-upload" class="button-link">Vyberte soubory k nahrání</a> <input id="news-gallery-files-upload" type="file" multiple>
</p>

 <br>
<output id="news-gallery-file-list"></output>
<br class='clear'>

   </form>     
   <b>Nahrané obrázky:</b>
   <div class="gallery-admin-holder"> 
    <?php require_once '_ajax/news-gallery.php'; ?>
   </div> 
</div>   
   