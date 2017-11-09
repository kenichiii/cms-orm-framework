
    <input type='hidden' id='admin-pages-tree-url' value='<?php echo App::getIns()->setAjaxLink('_curr','page-tree') ?>'>
    <input type='hidden' id='admin-pages-page-url' value='<?php echo App::getIns()->setAjaxLink('_curr','page') ?>'>
    <input type='hidden' id='admin-pages-add-url' value='<?php echo App::getIns()->setActionLink( '_curr', 'add' ); ?>'>
    <input type='hidden' id='admin-pages-update-url' value='<?php echo App::getIns()->setActionLink( '_curr', 'update' ); ?>'>
    <input type='hidden' id='admin-pages-update-content-url' value='<?php echo App::getIns()->setActionLink( '_curr', 'update-content' ); ?>'>
    <input type='hidden' id='admin-pages-delete-url' value='<?php echo App::getIns()->setActionLink( '_curr', 'delete' ); ?>'>
    
    
        
    <div id='pages-menu-panel' class='fleft' style='padding-right: 40px'>
        <h2><?php _et("CMS stránky","section-admin"); ?></h2>  
        
        <div style="padding-bottom: 7px;<?php if(count(Project::$languages)==1&&count(Project::$adminlanguages)==1&&Project::$languages[0]==Project::$adminlanguages[0]) echo 'display:none;' ?>">
            verze <select id="view-lang">
                <?php foreach(Project::$languages as $lang) { ?>
                <option <?php if($lang==App::getIns()->getLang()) echo 'selected="selected"' ?> value="<?php echo $lang; ?>"><?php echo $lang; ?></option>
                <?php } ?>
                <?php foreach(Project::$adminlanguages as $alang) { if(!in_array($alang, Project::$languages)) { ?>
                <option value="<?php echo $alang; ?>">admin - <?php echo $alang; ?></option>
                <?php } } ?>                
            </select>    
        </div>
        
        <a id="newrootpage" class="button-link-after" href='#'>nová stránka</a>    
        <div id='tree'>
            Nahrávám stránky...
        </div>    
        <br><br>
        <a id="clearcache" class="button-link" href='<?php echo App::getIns()->setActionLink('_curr','cache-clear') ?>'>vyčistit cache</a>    
    </div>    

    <div id='page-window' class='fleft' style='max-width: 1000px'>
        <h2>Administrace webových stránek</h2>
       
        <div class="">
            Vyberte stránku k zobrazení
        </div>
    </div>    

    <br class='clear'>