
<?php 

function pagesoptions($parentid,$nested="-") { 
   $options = '';
        
                     foreach(App::getIns()->getPages() as $key=>$mpage) { 
                        if($mpage->getParentId()->getValue()==$parentid) {
                           $options .= '<option value="'.$mpage->getId()->getValue().'">'. $nested.' '.$mpage->getMenuName()->getValue().'</option>'."\n";
                           $options .= pagesoptions($mpage->getId()->getValue(),$nested.'--');
                         }  
                     }
                     
   return $options;                  
} 

?> 

        <div class="hidden" id="page-parentid-select-html">
                  <select name="parentid"> 
                    <option value="0">ROOT</option>
                    <?php echo pagesoptions(0) ?>
                  </select> 
        </div>


<input type="hidden" id="write-model-link" value="<?php echo App::getIns()->setActionLink('_curr','write-model') ?>">
<input type="hidden" id="create-page-link" value="<?php echo App::getIns()->setActionLink('_curr','create-page') ?>">
<input type="hidden" id="write-page-part-link" value="<?php echo App::getIns()->setActionLink('_curr','write-page-part') ?>">
<input type="hidden" id="write-component-part-link" value="<?php echo App::getIns()->setActionLink('_curr','write-component-part') ?>">
<input type="hidden" id="run-sql-link" value="<?php echo App::getIns()->setActionLink('_curr','run-sql') ?>">

<h1>Project dev lab v0.1beta</h1>
<a class="genmenu" href="#project-menu">[Project]</a>
<a class="genmenu" href="#new-model-menu">[New Model]</a>
<a class="genmenu" href="#new-page-menu">[Add Page]</a>
<a class="genmenu" href="#new-component-menu">[Add Admin]</a>
<a class="genmenu" href="#grid-sql">[Grid SQL]</a>

<div class="hidden genmenu-window" id="project-menu">
<b>Project: </b>
<a id="project-config-link-login" href="<?php echo Project::$WEB_URL . '/' . Project::$DEV_INSTALL_URI.'/'?>">[CONFIG]</a>
<input type="hidden" id="idconfiglogin" value="<?php echo Project::$installAuthLogin; ?>">
<input type="hidden" id="idconfigpwd" value="<?php echo Project::$installAuthPwd; ?>">
<a id="project-config-link"  href="<?php echo Project::$WEB_URL . '/' . Project::$DEV_INSTALL_URI.'/'?>" class="blank"></a>
<a href="#" class="form" id="project-settings">[SETTINGS]</a>
</div>

<div class="hidden genmenu-window" id="grid-sql">
<b>Action: </b>
<a href="#" class="form" id="create-table">[CREATE TABLE]</a>
<a href="#" class="form" id="alter-table">[ALTER TABLE]</a>
</div>


<div class="hidden genmenu-window" id="new-model-menu">
<b>Models: </b>

<a href="#" class="form" id="model-model">[NEW MODEL]</a>
<a href="#" class="form" id="model-grid">[NEW GRID]</a>
<a href="#" class="form" id="model-datatable">[NEW DATAGRID]</a>
<a href="#" class="form" id="model-form">[NEW FORM]</a>
<a href="#" class="form" id="model-nestedgrid">[NEW NESTED LIST]</a>

</div>

<div class="hidden genmenu-window" id="new-page-menu">
<b>Components: </b>

<a href="#" class="form" id="page-grid-list">[GRID LIST]</a>
<a href="#" class="form" id="page-model-view">[MODEL VIEW]</a>
<a href="#" class="form" id="page-form-action">[MODEL FORM]</a>
<a href="#" class="form" id="page-component-gallery">[ADD GALLERY]</a>

</div>

<div class="hidden genmenu-window" id="new-component-menu">
<b>Components: </b>
<a href="#" class="form" id="component-datatable">[ADD DATATABLE]</a>
<a href="#" class="form" id="component-gallery">[ADD GALLERY,DOCS]</a>
<a href="#" class="form" id="component-grid-list-admin">[ADD GRID LIST]</a>
<a href="#" class="form" id="page-file-form">[FILE ADMIN FORM]</a>
</div>

<div id="project-settings-form"  class="form-window">
    <h3>SETTINGS</h3>
  <?php require_once App::getIns()->getPagesFolder() .'/'. App::getIns()->getCurrentPath() . '_templates/form.project.settings.php' ?>
 </div>   

<div id="component-datatable-form"  class="form-window">
    <h3>ADD DATATABLE</h3>
  <?php require_once App::getIns()->getPagesFolder() .'/'. App::getIns()->getCurrentPath() . '_templates/form.component.datatable.php' ?>
 </div>   

<div id="component-grid-list-admin-form"  class="form-window">
    <h3>ADD GRID LIST ADMIN</h3>
  <?php require_once App::getIns()->getPagesFolder() .'/'. App::getIns()->getCurrentPath() . '_templates/form.admin.grid.list.php' ?>
 </div>   

<div id="component-gallery-form"  class="form-window">
    <h3>ADD GALLERY, ADD DOCS</h3>
  <?php require_once App::getIns()->getPagesFolder() .'/'. App::getIns()->getCurrentPath() . '_templates/form.component.gallery.admin.php' ?>
 </div>   

<div id="page-component-gallery-form"  class="form-window">
    <h3>ADD GALLERY</h3>
  <?php require_once App::getIns()->getPagesFolder() .'/'. App::getIns()->getCurrentPath() . '_templates/form.component.gallery.page.php' ?>
 </div>   

<div id="model-model-form"  class="form-window">
    <h3>NEW MODEL</h3>
    <?php require_once App::getIns()->getPagesFolder() .'/'. App::getIns()->getCurrentPath() . '_templates/form.model.model.php' ?>
</div> 

<div id="model-datatable-form"  class="form-window">
    <h3>NEW dataGrid</h3>
    <?php require_once App::getIns()->getPagesFolder() .'/'. App::getIns()->getCurrentPath() . '_templates/form.model.datatable.php' ?>
</div> 


<div id="model-grid-form"  class="form-window">
    <h3>NEW GRID</h3>
    <?php require_once App::getIns()->getPagesFolder() .'/'. App::getIns()->getCurrentPath() . '_templates/form.model.grid.php' ?>
</div>    

<div id="model-form-form"  class="form-window">
    <h3>NEW FORM</h3>
    <?php require_once App::getIns()->getPagesFolder() .'/'. App::getIns()->getCurrentPath() . '_templates/form.model.form.php' ?>
</div>    
    
   
<div id="create-table-form" class="form-window">
    <h3>CREATE TABLE SQL</h3>
<form class="template" method="get" action="<?php echo App::getIns()->setAjaxLink(  '_curr', 'grid_create_sql' ) ?>">
    Grid: <input type="text" name="grid"> <input type="submit" value="Generovat">
</form>    
</div>

<div id="alter-table-form" class="form-window">
    <h3>ALTER TABLE SQL</h3>
<form class="template" method="get" action="<?php echo App::getIns()->setAjaxLink(  '_curr', 'grid_alter_sql' ) ?>">
    Grid: <input type="text" name="grid"> <input type="submit" value="Generovat">
</form>    
</div>

<div id="page-model-view-form" class="form-window">
    <h3>MODEL VIEW PAGE</h3>
    <?php require_once App::getIns()->getPagesFolder() .'/'. App::getIns()->getCurrentPath() . '_templates/form.page.model.view.php' ?>
</div>

<div id="page-grid-list-form" class="form-window">
    <h3>GRID LIST PAGE</h3>
    <?php require_once App::getIns()->getPagesFolder() .'/'. App::getIns()->getCurrentPath() . '_templates/form.page.grid.list.php' ?>
</div>

<div id="page-form-action-form" class="form-window">
    <h3>MODEL FORM PAGE</h3>
    <?php require_once App::getIns()->getPagesFolder() .'/'. App::getIns()->getCurrentPath() . '_templates/form.page.form.model.php' ?>
</div>

<div id="page-file-form-form" class="form-window">
    <h3>FILE UPLOAD FORM PAGE</h3>
    <?php require_once App::getIns()->getPagesFolder() .'/'. App::getIns()->getCurrentPath() . '_templates/form.page.form.file.php' ?>
</div>

   
<div id="output" class="hidden">
    <div class="title"><h2>Generated files:</h2></div>
    <div class="report"></div>
    <div class="mainactions"></div>
    <div class='header'></div>
    <div class='files'></div>
</div>

