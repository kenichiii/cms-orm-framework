<div class='page-edit-holder'>
    <input type="hidden" id="page-id" value="<?php echo $bean->get('id')->getValue() ?>">
    <h2><?php echo $bean->getH1()->getValue() ?></h2>
    
    <div class='tabs-holder'>
        <div class='tabs-head'>
            <a href='#tab-edit'>Základní informace</a>
            <a href='#tab-content'>Obsah</a>            
            <a href='#tab-gallery'>Galerie</a>
            <a id="tab-menu-system" href='#tab-system'>Nastavení</a>            

            <br class="clear">
        </div>   
        <div class='tabs-bodies'>
            
  <div id='tab-edit' class='tab' style="width:850px">
        <h3>Základní údaje</h3>
        
        
        
       <div style="float:right"> 
        <div style="padding-bottom: 5px;"><h3>Ikona stránky</h3></div>   
        <?php require '_templates/form.page.foto.holder.php' ?>   
       </div> 
        
        
        
        
       <div class="model-form-holder">
        <form id="pageformedit" action="<?php echo App::getIns()->setActionLink('_curr','edit-basic') ?>" method="post">                        
        
        <span class='error'></span>    
        
                                <input type="hidden" name="id" value="<?php echo $bean->get('id')->getValue() ?>">
                                                                                                                                                                                                                                                                                                                                                                                                                                            

<div class="model-form-row">

   <label for="active"> 
    <input <?php echo $bean->get('active')->getValue() > 0 ? 'checked="checked"' : '' ?> type="checkbox" id="active" name="active" value="1">
    Aktivní    
   </label> 

   <label for="showinmenu"> 
    <input <?php echo $bean->get('showinmenu')->getValue() > 0 ? 'checked="checked"' : '' ?> type="checkbox" id="showinmenu" name="showinmenu" value="1">
    V menu    
   </label> 

   <label for="footermenu"> 
    <input <?php echo $bean->get('footermenu')->getValue() > 0 ? 'checked="checked"' : '' ?> type="checkbox" id="footermenu" name="footermenu" value="1">
    V menu patičky    
   </label> 

</div>          

        
<div class="model-form-row">
    <div class="model-form-collum-title">
        Nadpis    </div>    
    <div class="model-form-collum-cell">
        <input type="text" name="h1" value="<?php echo $bean->get('h1')->getValue() ?>">
    </div>            
</div>  


<div class="model-form-row">
    <div class="model-form-collum-title">
        Název v menu    </div>    
    <div class="model-form-collum-cell">
        <input type="text" name="menuname" value="<?php echo $bean->get('menuname')->getValue() ?>">
    </div>            
</div>  

<div class="model-form-row">
    <div class="model-form-collum-title">
        Uri    </div>    
    <div class="model-form-collum-cell">
        <input type="text" name="uri" value="<?php echo $bean->get('uri')->getValue() ?>">
    </div>            
</div>  
        

<div class="model-form-row">
    <div class="model-form-collum-title description">
        SEO popis    </div>    
    <div class="model-form-collum-cell">
        <textarea name="description"><?php echo $bean->get('description')->getValue(); ?></textarea>
    </div>         
</div>      
                                
            <div class="model-form-submit">
                <input type="submit" value="Uložit">
            </div>    
                        
        </form>    
        

       </div>  
       <br class="clear">
                
                
            </div> <!-- end page edit tab -->
      

            <div id='tab-content' class='tab'>
                <h3>Obsah stránky</h3>
                <form id="contentForm" action="<?php echo App::getIns()->setActionLink('_curr', 'edit-content')?>" method="post">                       
                <div class='page-content'>
                  
                
                        <input type="hidden" name="id" value="<?php echo $bean->getId()->getValue() ?>">                 
        
                        <textarea name="content" id="content"><?php echo $bean->getContent()->getValue() ?></textarea>

            
                </div>
                 <br>            
                 <div class="model-form-submit"><input type="submit" class='page-content-update-btn' value="Uložit"></div>
              </form>  
            </div>            
    
                    
            <div id='tab-gallery' class='tab'>
               <?php require '_templates/template.page.gallery.holder.php' ?>     
            </div>                         
            
      <div id='tab-system' class='tab'>
        <h3>Systémová nastavení</h3>          
       <div class="model-form-holder">
        <form id="pageformeditsystem" action="<?php echo App::getIns()->setActionLink('_curr','edit-system') ?>" method="post">                        
        
        <span class='error'></span>    
        
                                <input type="hidden" name="id" value="<?php echo $bean->get('id')->getValue() ?>">

<div class="model-form-row">
    <div class="model-form-collum-title">
        Id    </div>    
    <div class="model-form-collum-cell">
        <?php echo $bean->get('id')->getValue() ?>
    </div>            
</div>    
                                
<div class="model-form-row">

  <div class="model-form-collum-title"> 
   <input <?php echo $bean->get('cache')->getValue() > 0 ? 'checked="checked"' : '' ?> type="checkbox" id="cacheactive" name="cache" value="1">   
   <label for="cacheactive">     
    Cache on    
   </label> 
    </div>    
    <div class="model-form-collum-cell">
        <input type="text" name="cachelifetime" value="<?php echo $bean->get('cachelifetime')->getValue() ?>">
    </div>   
</div>                                  
                                
<div class="model-form-row">
    <div class="model-form-collum-title">
        Access    </div>    
    <div class="model-form-collum-cell">
        <input type="text" name="access" value="<?php echo $bean->get('access')->getValue() ?>">
    </div>            
</div>  


<div class="model-form-row">
    <div class="model-form-collum-title">
        Pointer    </div>    
    <div class="model-form-collum-cell">
        <input type="text" name="pointer" value="<?php echo $bean->get('pointer')->getValue() ?>">
    </div>            
</div>                                 

<div class="model-form-row">
    <div class="model-form-collum-title">
        Path app/<?php echo App::getIns()->getPagesFolder(); ?>/
    </div>    
    <div class="model-form-collum-cell">
        <?php        
          if($bean->get('active')->getValue()>0)
          {
            //init page home or 404 for default lang
            $help = App::init('/'.$bean->get('lang')->getValue(),false);
            $app = App::init(str_replace(Project::$WEB_URL, '', $help->setLink($bean->get('pointer')->getValue())),false);
            echo $app->getCurrentPath()          
        ?> &nbsp;&nbsp; 
        <a id="create-page-folder" class="button-link" href="<?php echo App::getIns()->setActionLink('_curr','create-page-folder')?>?path=<?php echo $app->getCurrentPath() ?>">create dir</a>
            
        <a id="create-page-assets-folder" class="button-link" href="<?php echo App::getIns()->setActionLink('_curr','create-page-assets-folder')?>?path=<?php echo $app->getCurrentPath() ?>">create assets dir</a>
     <?php } else { ?>neaktivní<?php } ?>
    </div>            
</div>                                 
                                
                                
                                
<div class="model-form-row">
    <div class="model-form-collum-title">
        Typ    </div>    
    <div class="model-form-collum-cell"> 
    <select name="type">
        <option value="">vyberte</option>
                    <option <?php echo $bean->get('type')->getValue() == 'text' ? 'selected=""selected' : ''; ?> value="text">Textová stránka</option>
                    <option <?php echo $bean->get('type')->getValue() == 'system' ? 'selected=""selected' : ''; ?> value="system">Systémová stránka</option>
            </select>    
    </div>            
</div>  
                               
<div class="model-form-row">
    <div class="model-form-collum-title">
        Jazyk    </div>    
    <div class="model-form-collum-cell">
        <input type="text" name="lang" value="<?php echo $bean->get('lang')->getValue() ?>">
    </div>            
</div>  

<div class="model-form-row">
    <div class="model-form-collum-title">
        Layout    </div>    
    <div class="model-form-collum-cell">
        <input type="text" name="layout" value="<?php echo $bean->get('layout')->getValue() ?>">
    </div>            
</div>  
    
                                     
            
            <div class="model-form-submit">
                <input type="submit" value="Uložit">
            </div>    
                        
        </form>    
        
            
       </div>  
       <br class="clear">
                
                
            </div> <!-- end tab-system -->

   
            
        </div>       
    </div>
    
    
</div>
