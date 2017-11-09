
<div class="dataGrid" id="refs">    

    <input type="hidden" name="dataGridSource" value="<?php echo App::getIns()->setAjaxLink('_curr','refs-datatable') ?>">
    <input type="hidden" name="dataGridAutocomplete" value="<?php echo App::getIns()->setAjaxLink('_curr','refs-autocomplete') ?>">
        <input type="hidden" name="dataGridAddNewRecord" value="<?php echo App::getIns()->setAjaxLink('_curr','refs-add') ?>">
            <input type="hidden" name="dataGridActionedit" value="<?php echo App::getIns()->setAjaxLink('_curr','refs-edit') ?>">
        <input type="hidden" name="dataGridActionmoveup" value="<?php echo App::getIns()->setAjaxLink('_curr','refs-moveup') ?>">
        <input type="hidden" name="dataGridActionmovedown" value="<?php echo App::getIns()->setAjaxLink('_curr','refs-movedown') ?>">
        <input type="hidden" name="dataGridActiondelete" value="<?php echo App::getIns()->setAjaxLink('_curr','refs-delete') ?>">

    <div class="dataGridContent">
        Nahrávám data...
    </div>

</div>