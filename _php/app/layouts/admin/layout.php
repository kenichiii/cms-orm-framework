<!DOCTYPE html>
<html lang="<?php echo App::getIns()->getLangISO(); ?>">
  <head>
    <meta charset="utf-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
        <title><?php $pagetree = App::getIns()->getPageTree(); 
                for($i=count($pagetree)-1;$i>=0;$i-- ) { 
                    if($i!=count($pagetree)-1) { echo ' :: '; echo strip_tags( $pagetree[$i]->getMenuName()->getValue() ); }  
                    else echo  strip_tags( $pagetree[$i]->getH1()->getValue() ); } 
                    echo ' :: ' . Project::$title; ?></title>

    
                
           	<link type="text/css" href="<?php echo Project::$WEB_URL; ?>/assets/libs/jquery_ui/jquery-ui-1.10.4.custom.min.css" rel="stylesheet">			                                                		        
                
                <link type="text/css" href="<?php echo Project::$WEB_URL; ?>/assets/libs/datatable/datagrid.css" rel="stylesheet">
                
                <link type="text/css" href="<?php echo Project::$WEB_URL; ?>/assets/layouts/common/css/layout.css" rel="stylesheet">
                <link type="text/css" href="<?php echo Project::$WEB_URL; ?>/assets/layouts/common/css/forms.css" rel="stylesheet">                                
                
                <link type="text/css" href="<?php echo Project::$WEB_URL; ?>/assets/layouts/admin/css/menu.css" rel="stylesheet">
                <link type="text/css" href="<?php echo Project::$WEB_URL; ?>/assets/layouts/admin/css/layout.css" rel="stylesheet">
                                                            
        
                <?php foreach( App::getIns()->getAddedFilesCss() as $File ): ?>
                <link type="text/css" href="<?php echo $File; ?>" rel="stylesheet">
                <?php endforeach ?>                             
                
                <?php foreach( App::getIns()->getAssetsFilesCss() as $File ): ?>
                <link type="text/css" href="<?php echo Project::$WEB_URL . $File; ?>" rel="stylesheet">
                <?php endforeach ?>                
                                                                
                <?php foreach( App::getIns()->getPhpFilesCss() as $File ): ?>
                <link type="text/css" href="<?php echo $File; ?>" rel="stylesheet">
                <?php endforeach ?> 
           
                <?php foreach( App::getIns()->getAddedFilesPhpCss() as $File ): ?>
                <link type="text/css" href="<?php echo $File; ?>" rel="stylesheet">
                <?php endforeach ?>                             
                
                
    </head>
    <body class="page-root-<?php echo App::getIns()->getRootPage()->getPointer()->getValue() ?>">
        
               
        <header>
          <div style="width:100%">  
            
          <?php

            if( access(array('admin'=>'user')) )
                {    
                     require App::getIns()->getLayoutTemplate('loggeduserbox');
                    
                   if(count(Project::$adminlanguages)>1)  
                   { require App::getIns()->getLayoutTemplate('languages'); }
                }
                
           ?>
            
            <a class="project-logo-href" href="<?php echo Project::$WEB_URL; ?>">
                <span><?php echo Project::$title; ?></span>
            </a> 
              
              
              
          </div>  
        </header>
      
                     
        <nav>    
          <?php

            if( access(array('admin'=>'user')) )
                {      
             require App::getIns()->getLayoutTemplate('mainmenu');
                }
                
            ?>                                      
        </nav>        
        
       
       
        
       
                                                                                           
               <?php
               if( access(array('admin'=>'user')) )
                {      
            
                if( App::getIns()->currentPage()->getType()->getValue() == Page_Model::TYPE_SYSTEM )
                {
                  ?>  
                  <div class="current-page-system-content">
                  <?php
                    if( file_exists( APPLICATION_PATH .'/'. App::getIns()->getLangTemplateSrc() ) )                    
                    {
                        require_once App::getIns()->getLangTemplateSrc();
                    }
                    else {
                        require_once App::getIns()->getTemplateSrc();
                    }
                   ?>
                   </div>
                   <?php 
                }
                
                } else require App::getIns()->getLayoutTemplate('login');
                ?>
          
                
                <?php
                        require App::getIns()->getLayoutTemplate('alert');
                ?>             
            
                <input type="hidden" id="popup-alert-message-link" value="<?php echo App::getIns()->setAjaxLink(Project::$ADMIN_PAGE_POINTER, 'alert') ?>">
    
            <!-- javascript  -->    
              
                <script type="text/javascript" src="<?php echo Project::$WEB_URL; ?>/assets/libs/jquery/jquery-1.6.2.min.js"></script>
                <script type="text/javascript" src="<?php echo Project::$WEB_URL; ?>/assets/libs/jquery_ui/jquery-ui-1.8.16.custom.min.js"></script>                            
              
                <script type="text/javascript" src="<?php echo Project::$WEB_URL; ?>/assets/libs/jquery_form/jquery.form.js"></script>
                
                <script type="text/javascript" src="<?php echo Project::$WEB_URL; ?>/assets/libs/jstree/jquery.jstree.js"></script>                                                
                
                <script src="<?php echo Project::$WEB_URL; ?>/assets/libs/tinymce/jquery.tinymce.min.js" type="text/javascript"></script>
                
                <script type="text/javascript" src="<?php echo Project::$WEB_URL; ?>/assets/libs/pfc_ui/ui.js"></script>
                
                <script src="<?php echo Project::$WEB_URL; ?>/assets/libs/datatable/datagrid.js" type="text/javascript"></script>
                
                <script type="text/javascript" src="<?php echo Project::$WEB_URL; ?>/assets/layouts/common/js/functions.js"></script>
                <script type="text/javascript" src="<?php echo Project::$WEB_URL; ?>/assets/layouts/common/js/control.js"></script>
        
          <?php
            if( access(array('admin'=>'user')) )
                {  ?><script type="text/javascript" src="<?php echo Project::$WEB_URL; ?>/assets/layouts/admin/js/menu.js"></script>
          <?php } ?>
                <script type="text/javascript" src="<?php echo Project::$WEB_URL; ?>/assets/layouts/admin/js/control.js"></script>

                <?php foreach( App::getIns()->getAddedFilesJs() as $FileJs ): ?>
		<script type="text/javascript" src="<?php echo $FileJs; ?>"></script>
                <?php endforeach ?>                                        
                
                <?php foreach( App::getIns()->getAssetsFilesJs() as $FileJs ): ?>
		<script type="text/javascript" src="<?php echo Project::$WEB_URL . $FileJs; ?>"></script>
                <?php endforeach ?>
                
                <?php foreach( App::getIns()->getPhpFilesJs() as $FileJs ): ?>
                <script type="text/javascript" src="<?php echo $FileJs; ?>"></script>
                <?php endforeach ?>        

                <?php foreach( App::getIns()->getAddedFilesPhpJs() as $FileJs ): ?>
		<script type="text/javascript" src="<?php echo $FileJs; ?>"></script>
                <?php endforeach ?>  
                
     <!-- end loading javascript -->   
                                                                                                    
<!-- 

    place for non-cached helpers 

    html body is closed by php
-->

