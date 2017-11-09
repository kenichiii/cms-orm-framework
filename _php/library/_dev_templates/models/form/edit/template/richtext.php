




<div class="model-form-row row-<?php echo $this->getCollum() ?>">
    <div class="model-form-collum-title">
        <?php echo $this->getTitle() ?>
    </div>    
    <div class="model-form-collum-cell err-<?php echo $this->getCollum() ?>">        
        <textarea class="tinymce" name="<?php echo $this->getCollum() ?>">[[ echo $bean->get('<?php echo $this->getCollum() ?>')->getValue() ]]</textarea>
    </div>            
</div>  
