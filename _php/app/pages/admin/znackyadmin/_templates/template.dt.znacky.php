<div class="dataGrid" id="znacky">    
             
    <input type="hidden" name="dataGridSource" value="<?php echo App::getIns()->setAjaxLink('_curr','znacky-datatable') ?>">
    <input type="hidden" name="dataGridAutocomplete" value="<?php echo App::getIns()->setAjaxLink('_curr','znacky-autocomplete') ?>">
        <input type="hidden" name="dataGridAddNewRecord" value="<?php echo App::getIns()->setAjaxLink('_curr','znacky-add') ?>">
            <input type="hidden" name="dataGridActionedit" value="<?php echo App::getIns()->setAjaxLink('_curr','znacky-edit') ?>">
        <input type="hidden" name="dataGridActiondelete" value="<?php echo App::getIns()->setAjaxLink('_curr','znacky-delete') ?>">
            

    
    <div class="dataGridContent">
        Nahrávám data...
    </div>

</div>