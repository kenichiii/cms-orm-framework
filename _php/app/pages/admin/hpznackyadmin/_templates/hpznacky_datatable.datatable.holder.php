
<div class="dataGrid" id="hpznacky_datatable">    

    <input type="hidden" name="dataGridSource" value="<?php echo App::getIns()->setAjaxLink('_curr','hpznacky_datatable-datatable') ?>">
    <input type="hidden" name="dataGridAutocomplete" value="<?php echo App::getIns()->setAjaxLink('_curr','hpznacky_datatable-autocomplete') ?>">
        <input type="hidden" name="dataGridAddNewRecord" value="<?php echo App::getIns()->setAjaxLink('_curr','hpznacky_datatable-add') ?>">
            <input type="hidden" name="dataGridActionedit" value="<?php echo App::getIns()->setAjaxLink('_curr','hpznacky_datatable-edit') ?>">
        <input type="hidden" name="dataGridActionmoveup" value="<?php echo App::getIns()->setAjaxLink('_curr','hpznacky_datatable-moveup') ?>">
        <input type="hidden" name="dataGridActionmovedown" value="<?php echo App::getIns()->setAjaxLink('_curr','hpznacky_datatable-movedown') ?>">
        <input type="hidden" name="dataGridActiondelete" value="<?php echo App::getIns()->setAjaxLink('_curr','hpznacky_datatable-delete') ?>">

    <div class="dataGridContent">
        Nahrávám data...
    </div>

</div>