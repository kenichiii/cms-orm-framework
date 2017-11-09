
<div class='foto-upload-form-holder' id="homebanner_foto">
<input type="hidden" id="homebanner-foto-url" value="<?php echo App::getIns()->setAjaxLink('_curr','homebanner-foto'); ?>?id=<?php echo $bean->getId()->getValue(); ?>">     
<form id="homebanner-foto-upload-form" enctype="multipart/form-data" method="post" action="<?php echo App::getIns()->setActionLink('_curr','homebanner-foto-upload'); ?>?id=<?php echo $bean->getId()->getValue(); ?>">

    <inpu id="homebanner-foto-ownerid" typr="hidden" name="id" value="<?php echo $bean->getId()->getValue(); ?>">
    
<p>
    <a href="#" id="homebanner-foto-button-upload" class="button-link">Vyberte soubor k nahrání</a> <input id="homebanner-foto-file-upload" type="file">
</p>

 <br>
<output id="homebanner-foto-file-output"></output>
    <br class='clear'>
    
</form>        
   <div class="homebanner-foto-img-holder"> 
    <?php require '_ajax/homebanner-foto.php'; ?>
   </div> 
</div> 
