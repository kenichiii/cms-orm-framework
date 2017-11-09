<div class="dataGrid" id="admins">    
             
    <input type="hidden" name="dataGridSource" value="<?php echo App::getIns()->setAjaxLink('_curr','admins-datatable') ?>">
    <input type="hidden" name="dataGridAutocomplete" value="<?php echo App::getIns()->setAjaxLink('_curr','admins-autocomplete') ?>">
        <input type="hidden" name="dataGridAddNewRecord" value="<?php echo App::getIns()->setAjaxLink('_curr','admins-add') ?>">
            <input type="hidden" name="dataGridActionedit" value="<?php echo App::getIns()->setAjaxLink('_curr','admins-edit') ?>">
        <input type="hidden" name="dataGridActionpassword" value="<?php echo App::getIns()->setAjaxLink('_curr','admins-password') ?>">
        <input type="hidden" name="dataGridActiondelete" value="<?php echo App::getIns()->setAjaxLink('_curr','admins-delete') ?>">
            

    
    <div class="dataGridContent">
        Nahrávám data...
    </div>

</div>