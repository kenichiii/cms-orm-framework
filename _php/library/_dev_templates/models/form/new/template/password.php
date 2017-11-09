


<div class="model-form-row row-<?php echo $this->getCollum() ?>">
    <div class="model-form-collum-title">
        <?php echo $this->getTitle() ?>
    </div>    
    <div class="model-form-collum-cell">
        <input type="password" name="<?php echo $this->getCollum() ?>" value="<?php echo $this->getDefault() ?>">
    </div>            
</div>  

<div class="model-form-row row-<?php echo $this->getCollum() ?>_again">
    <div class="model-form-collum-title">
        <?php echo $this->getTitle() ?> znova
    </div>    
    <div class="model-form-collum-cell">
        <input type="password" name="<?php echo $this->getCollum() ?>_again" value="<?php echo $this->getDefault() ?>">
    </div>            
</div>  
