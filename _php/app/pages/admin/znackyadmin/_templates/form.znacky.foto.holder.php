
<div class='foto-upload-form-holder' id="znacky_foto">
<input type="hidden" id="znacky-foto-url" value="<?php echo App::getIns()->setAjaxLink('_curr','znacky-foto'); ?>?id=<?php echo $bean->getId()->getValue(); ?>">     
<form id="znacky-foto-upload-form" enctype="multipart/form-data" method="post" action="<?php echo App::getIns()->setActionLink('_curr','znacky-foto-upload'); ?>?id=<?php echo $bean->getId()->getValue(); ?>">

    <inpu id="znacky-foto-ownerid" typr="hidden" name="id" value="<?php echo $bean->getId()->getValue(); ?>">
    
<p>
    <a href="#" id="znacky-foto-button-upload" class="button-link">Vyberte soubor k nahrání</a> <input id="znacky-foto-file-upload" type="file">
</p>

 <br>
<output id="znacky-foto-file-output"></output>
    <br class='clear'>
    
</form>        
   <div class="znacky-foto-img-holder"> 
    <?php require '_ajax/znacky-foto.php'; ?>
   </div> 
</div> 
