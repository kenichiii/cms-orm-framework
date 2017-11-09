
<div class='foto-upload-form-holder' id="news_foto">
<input type="hidden" id="news-foto-url" value="<?php echo App::getIns()->setAjaxLink('_curr','news-foto'); ?>?id=<?php echo $bean->getId()->getValue(); ?>">     
<form id="news-foto-upload-form" enctype="multipart/form-data" method="post" action="<?php echo App::getIns()->setActionLink('_curr','news-foto-upload'); ?>?id=<?php echo $bean->getId()->getValue(); ?>">

    <inpu id="news-foto-ownerid" typr="hidden" name="id" value="<?php echo $bean->getId()->getValue(); ?>">
    
<p>
    <a href="#" id="news-foto-button-upload" class="button-link">Vyberte soubor k nahrání</a> <input id="news-foto-file-upload" type="file">
</p>

 <br>
<output id="news-foto-file-output"></output>
    <br class='clear'>
    
</form>        
   <div class="news-foto-img-holder"> 
    <?php require '_ajax/news-foto.php'; ?>
   </div> 
</div> 
