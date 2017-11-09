
<?php

$ownerId = $grid->getModel()->isOwnerIdAble();
$parentId = $grid->getModel()->isParentIdAble();
$rank = $grid->getModel()->isRankAble();
$active = $grid->getModel()->isActiveAble();
$photo = $grid->getModel()->isPhotoAble();
$h1 = $grid->getModel()->isH1Able();
$uri = $grid->getModel()->isUriAble();
$date = $grid->getModel()->isDateAble();
$perex = $grid->getModel()->isPerexAble();
$content = $grid->getModel()->isContentAble();
$created = $grid->getModel()->isCreatedAble();
$lastupdate = $grid->getModel()->isLastupdateAble();


?>


    <div class="<?php echo $grid->getName(); ?>-holder">
        
        <input type="hidden" name="list" value="[[ echo App::getIns()->setAjaxLink('_curr','<?php echo $grid->getName(); ?>-list'); ]]">
        <input type="hidden" name="edit-action" value="[[ echo App::getIns()->setAjaxLink('_curr','<?php echo $grid->getName(); ?>-edit'); ]]">
        
        <input type="hidden" name="action-add-action" value="[[ echo App::getIns()->setActionLink('_curr','<?php echo $grid->getName(); ?>-add'); ]]">
        <input type="hidden" name="action-edit-action" value="[[ echo App::getIns()->setActionLink('_curr','<?php echo $grid->getName(); ?>-edit'); ]]">
        <input type="hidden" name="action-delete-action" value="[[ echo App::getIns()->setActionLink('_curr','<?php echo $grid->getName(); ?>-delete'); ]]">
        <?php if($rank) { ?>
        <input type="hidden" name="action-sort-action" value="[[ echo App::getIns()->setActionLink('_curr','<?php echo $grid->getName(); ?>-sort'); ]]">
        <?php } ?>
        <?php if($parentId) { ?>
        <input type="hidden" name="parentid" value="[[ echo isset($bean)?$bean->get('<?php echo $grid->getModel()->getPrimaryKey()->getCollum(); ?>')->getValue():0; ]]">
        <?php } ?>
        <?php if($ownerId) { ?>
        <input type="hidden" name="ownerid" value="[[ echo $bean->get('<?php echo $grid->getModel()->getPrimaryKey()->getCollum(); ?>')->getValue(); ]]">
        <?php } ?>
        
        
        
        <h3><?php echo $grid->getTitle(); ?></h3>
        <div style='margin-bottom: 12px;'>
        <a class='button-link action-add' href="[[ echo App::getIns()->setAjaxLink('_curr','<?php echo $grid->getName(); ?>-add'); ]]">
            Přidat nový záznam
        </a>
        </div>
        <?php if($grid->getModel()->isLangAble()) { ?>
        <div class="langHolder" style='margin-bottom: 12px;'>
            Jazyk: <select name="lang"><?php foreach (Project::$languages as $key => $value) {?><option value="<?php echo $value; ?>"><?php echo $value; ?></option><?php } ?></select>
        </div>    
        <?php } ?>

        <div class="list-holder">
            Nahrávám data...
        </div>    
        
      </div>   <!-- <?php echo $grid->getName(); ?>-holder  -->     

      <br class="clear">
      
      