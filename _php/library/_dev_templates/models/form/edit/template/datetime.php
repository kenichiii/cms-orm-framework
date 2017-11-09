
    [[                     
            $idate = $bean->get('<?php echo $this->getCollum() ?>')->getInDate('j.n.Y');
            $hours = $bean->get('<?php echo $this->getCollum() ?>')->getInDate('G');
            $min   = $bean->get('<?php echo $this->getCollum() ?>')->getInDate('i');
            $sec   = $bean->get('<?php echo $this->getCollum() ?>')->getInDate('s');
       ]]   
       
       
<div class="model-form-row row-<?php echo $this->getCollum() ?>">
    <div class="model-form-collum-title">
        <?php echo $this->getTitle() ?>
    </div>    
    <div class="model-form-collum-cell"> 
        
    <input type="text" name="<?php echo $this->getName() ?>_date" value="<?php echo $idate; ?>"> 
    <select name="<?php echo $this->getName() ?>_hours" class="idatetime">
        <?php for($i=0;$i<24;$i++) { ?>
            <option <?php echo $i == $hours ? 'selected="selected"' : '' ?> value="<?php echo $i ?>"><?php echo $i ?></option>
        <?php } ?>
    </select>    
    <select name="<?php echo $this->getName() ?>_min" class="idatetime">
        <?php for($i=0;$i<60;$i++) { ?>
            <option <?php echo $i == $min ? 'selected="selected"' : '' ?> value="<?php echo $i ?>"><?php echo $i ?></option>
        <?php } ?>
    </select>       
    <select name="<?php echo $this->getName() ?>_sec" class="idatetime">
        <?php for($i=0;$i<60;$i++) { ?>
            <option <?php echo $i == $sec ? 'selected="selected"' : '' ?> value="<?php echo $i ?>"><?php echo $i ?></option>
        <?php } ?>
    </select>        
                                                
    </div>            
</div>  
