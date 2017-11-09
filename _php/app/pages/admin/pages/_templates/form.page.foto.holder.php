
<div class='foto-upload-form-holder' id="page_foto">
<input type="hidden" id="page-foto-url" value="<?php echo App::getIns()->setAjaxLink('_curr','page-foto'); ?>?id=<?php echo $bean->getId()->getValue(); ?>">     
<form id="page-foto-upload-form" enctype="multipart/form-data" method="post" action="<?php echo App::getIns()->setActionLink('_curr','page-foto-upload'); ?>?id=<?php echo $bean->getId()->getValue(); ?>">

    <inpu id="page-foto-ownerid" typr="hidden" name="id" value="<?php echo $bean->getId()->getValue(); ?>">
    
<p>
    <a href="#" id="page-foto-button-upload" class="button-link">Vyberte soubor k nahrání</a> <input id="page-foto-file-upload" type="file">
</p>

 <br>
<output id="page-foto-file-output"></output>
    <br class='clear'>
    
</form>        
   <div class="page-foto-img-holder"> 
    <?php require '_ajax/page-foto.php'; ?>
   </div> 
</div> 
