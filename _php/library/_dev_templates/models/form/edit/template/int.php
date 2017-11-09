


    
    
<div class="model-form-row row-<?php echo $this->getCollum() ?>">
    <div class="model-form-collum-title">
        <?php echo $this->getTitle() ?>
    </div>    
    <div class="model-form-collum-cell"> 
        <input type="text" name="<?php echo $this->getCollum() ?>" value="[[ echo $bean->get('<?php echo $this->getCollum() ?>')->getValue() ]]">
    </div>            
</div>  
  