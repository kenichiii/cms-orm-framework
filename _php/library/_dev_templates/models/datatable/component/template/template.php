
<div class="dataGrid" id="<?php echo $model->getHtmlID(); ?>">    
             
    <input type="hidden" name="dataGridSource" value="[[ echo App::getIns()->setAjaxLink('_curr','<?php echo $model->getHtmlID(); ?>-datatable') ]]">
    <input type="hidden" name="dataGridAutocomplete" value="[[ echo App::getIns()->setAjaxLink('_curr','<?php echo $model->getHtmlID(); ?>-autocomplete') ]]">
    <?php if($hasActionNew) { ?>
    <input type="hidden" name="dataGridAddNewRecord" value="[[ echo App::getIns()->setAjaxLink('_curr','<?php echo $model->getHtmlID(); ?>-add') ]]">
    <?php } ?>
    <?php foreach ($model->getActions() as $action=>$data ) { ?>
    <input type="hidden" name="dataGridAction<?php echo $action; ?>" value="[[ echo App::getIns()->setAjaxLink('_curr','<?php echo $model->getHtmlID(); ?>-<?php echo $action; ?>') ]]">
    <?php } ?>
    <?php foreach ($model->getGroupActions() as $action=>$data ) { ?>
    <input type="hidden" name="checkboxes<?php echo $action; ?>" value="[[ echo App::getIns()->setAjaxLink('_curr','<?php echo $model->getHtmlID(); ?>-common-<?php echo $action; ?>') ]]">
    <?php } ?>    

    
    <div class="dataGridContent">
        Nahrávám data...
    </div>

</div>