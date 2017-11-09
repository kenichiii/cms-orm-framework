

<div class="model-form-row row-<?php echo $this->getCollum() ?>">
    

   <input <?php if($this->getDefault()>0) echo 'checked="checked"' ?> type="checkbox" id="<?php echo $form->getName().'-'.$this->getCollum() ?>" name="<?php echo $this->getCollum() ?>" value="1">
   <label for="<?php echo $form->getName().'-'.$this->getCollum() ?>">     
    <?php echo $this->getTitle() ?>    
   </label> 
    
</div>  





