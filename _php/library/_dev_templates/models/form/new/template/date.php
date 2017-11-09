

    

<div class="model-form-row row-<?php echo $this->getCollum() ?>">
    <div class="model-form-collum-title">
        <?php echo $this->getTitle() ?>
    </div>    
    <div class="model-form-collum-cell">
     <input type="text" name="<?php echo $this->getCollum() ?>" <?php if($this->getDefault()) { ?>value="<?php echo date('j.n.Y',  strtotime($this->getDefault())) ?>"<?php } ?>>
    </div>            
</div>  
