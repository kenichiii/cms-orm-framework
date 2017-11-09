<div class="dataGrid" id="napiste">    
             
    <input type="hidden" name="dataGridSource" value="<?php echo App::getIns()->setAjaxLink('_curr','napiste-datatable') ?>">
    <input type="hidden" name="dataGridAutocomplete" value="<?php echo App::getIns()->setAjaxLink('_curr','napiste-autocomplete') ?>">
            <input type="hidden" name="dataGridActionview" value="<?php echo App::getIns()->setAjaxLink('_curr','napiste-view') ?>">
        <input type="hidden" name="dataGridActiondelete" value="<?php echo App::getIns()->setAjaxLink('_curr','napiste-delete') ?>">
            

    
    <div class="dataGridContent">
        Nahrávám data...
    </div>

</div>