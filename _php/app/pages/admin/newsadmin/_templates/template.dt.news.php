<div class="dataGrid" id="news">    
             
    <input type="hidden" name="dataGridSource" value="<?php echo App::getIns()->setAjaxLink('_curr','news-datatable') ?>">
    <input type="hidden" name="dataGridAutocomplete" value="<?php echo App::getIns()->setAjaxLink('_curr','news-autocomplete') ?>">
        <input type="hidden" name="dataGridAddNewRecord" value="<?php echo App::getIns()->setAjaxLink('_curr','news-add') ?>">
            <input type="hidden" name="dataGridActionedit" value="<?php echo App::getIns()->setAjaxLink('_curr','news-edit') ?>">
        <input type="hidden" name="dataGridActiondelete" value="<?php echo App::getIns()->setAjaxLink('_curr','news-delete') ?>">
            

    
    <div class="dataGridContent">
        Nahrávám data...
    </div>

</div>