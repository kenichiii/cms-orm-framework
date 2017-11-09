
<div class='foto-upload-form-holder' id="reference_foto">
<input type="hidden" id="reference-foto-url" value="<?php echo App::getIns()->setAjaxLink('_curr','reference-foto'); ?>?id=<?php echo $bean->getId()->getValue(); ?>">     
<form id="reference-foto-upload-form" enctype="multipart/form-data" method="post" action="<?php echo App::getIns()->setActionLink('_curr','reference-foto-upload'); ?>?id=<?php echo $bean->getId()->getValue(); ?>">

    <inpu id="reference-foto-ownerid" typr="hidden" name="id" value="<?php echo $bean->getId()->getValue(); ?>">

<p>
    <a href="#" id="reference-foto-button-upload" class="button-link">Vyberte soubor k nahrání</a> <input id="reference-foto-file-upload" type="file">
</p>

 <br>
<output id="reference-foto-file-output"></output>
    <br class='clear'>

</form>        
   <div class="reference-foto-img-holder"> 
    <?php require '_ajax/reference-foto.php'; ?>
   </div> 
</div> 
