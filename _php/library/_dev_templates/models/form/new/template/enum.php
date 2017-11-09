



<div class="model-form-row row-<?php echo $this->getCollum() ?>">
    <div class="model-form-collum-title">
        <?php echo $this->getTitle() ?>
    </div>    
    <div class="model-form-collum-cell">
    <select name="<?php echo $this->getCollum() ?>">
        <option value=""> - vyberte - </option>
        <?php foreach ( $this->getTypes() as $key => $type ) { ?>
            <option <?php echo $this->getDefault() == $key ? 'selected=""selected' : ''; ?> value="<?php echo $key ?>"><?php echo $type ?></option>
        <?php } ?>
    </select>    
    </div>            
</div>  
