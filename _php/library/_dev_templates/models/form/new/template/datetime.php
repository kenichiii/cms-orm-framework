

<div class="model-form-row row-<?php echo $this->getCollum() ?>">
    <div class="model-form-collum-title">
        <?php echo $this->getTitle() ?>
    </div>    
    <div class="model-form-collum-cell">
    <?php 
        
        if( $this->getDefault() ) {
            
            $idate = Date('j.n.Y',  strtotime($this->getDefault()));
            $hours = Date('G',  strtotime($this->getDefault()));
            $min   = Date('i',  strtotime($this->getDefault()));
            $sec   = Date('s',  strtotime($this->getDefault()));
         ?>   
    <input type="text" name="<?php echo $this->getCollum() ?>_date" value="<?php echo $idate; ?>"> 
    <select name="<?php echo $this->getCollum() ?>_hours" class="idatetime">
        <?php for($i=0;$i<24;$i++) { ?>
            <option <?php echo $i == $hours ? 'selected="selected"' : '' ?> value="<?php echo $i ?>"><?php echo $i ?></option>
        <?php } ?>
    </select>    
    <select name="<?php echo $this->getCollum() ?>_min" class="idatetime">
        <?php for($i=0;$i<60;$i++) { ?>
            <option <?php echo $i == $min ? 'selected="selected"' : '' ?> value="<?php echo $i ?>"><?php echo $i ?></option>
        <?php } ?>
    </select>       
    <select name="<?php echo $this->getCollum() ?>_sec" class="idatetime">
        <?php for($i=0;$i<60;$i++) { ?>
            <option <?php echo $i == $sec ? 'selected="selected"' : '' ?> value="<?php echo $i ?>"><?php echo $i ?></option>
        <?php } ?>
    </select>        
                                                
    <?php        
        } else {
    ?>
    <input type="text" name="<?php echo $this->getCollum() ?>_date"> 
    <select name="<?php echo $this->getCollum() ?>_hours" class="idatetime">
        <?php for($i=0;$i<24;$i++) { ?>
            <option value="<?php echo $i ?>"><?php echo $i ?></option>
        <?php } ?>
    </select>    
    <select name="<?php echo $this->getCollum() ?>_min" class="idatetime">
        <?php for($i=0;$i<60;$i++) { ?>
            <option value="<?php echo $i ?>"><?php echo $i ?></option>
        <?php } ?>
    </select>       
    <select name="<?php echo $this->getCollum() ?>_sec" class="idatetime">
        <?php for($i=0;$i<60;$i++) { ?>
            <option value="<?php echo $i ?>"><?php echo $i ?></option>
        <?php } ?>
    </select>        
  <?php } ?>
    </div>            
</div>  
