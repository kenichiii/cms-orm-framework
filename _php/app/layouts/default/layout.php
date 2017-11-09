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
    
    <?php if( App::getIns()->currentPage()->getDescription()->getValue() ) { ?>
    <meta name="Description" content="<?php echo App::getIns()->currentPage()->getDescription()->getValue() ?>">
    <?php } ?>
    
           	<link type="text/css" href="<?php echo Project::$WEB_URL; ?>/assets/libs/jquery_ui/jquery-ui-1.10.4.custom.min.css" rel="stylesheet">			                                                		                        
                                                
                <link type="text/css" href="<?php echo Project::$WEB_URL; ?>/assets/layouts/common/css/layout.css" rel="stylesheet">
                <link type="text/css" href="<?php echo Project::$WEB_URL; ?>/assets/layouts/common/css/forms.css" rel="stylesheet">                                
                                
                <link type="text/css" href="<?php echo Project::$WEB_URL; ?>/assets/layouts/default/css/layout.css" rel="stylesheet">
                
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
                
                
        <?php echo AppSettings::getBySection('web')->GA_CODE; ?>        
                
                
    </head>
    <body>
        
      
      
<div class="holder">
    
     <header>
        <div class="header">  
            <div class="logo">
               <a id="logo" class="project-logo-href" href="<?php echo Project::$WEB_URL.'/'.App::getIns()->getLangPrefix(); ?>">
                <span><?php echo Project::$title; ?></span>
               </a>                       
            </div> 
            
              <nav>                    
                    <div class="menu">
                        <div class="menuInner">
                            <nav>
                                <?php require App::getIns()->getLayoutTemplate('mainmenu') ?>                                                                       
                            </nav>
                        </div>   
                    </div>  <!-- ./menu -->
              </nav>
        </div> <!-- ./header -->
     </header>
                                   
 <section>      
 <div id="contentBgHolder">          
    <div id="contentHolder" class="<?php echo App::getIns()->getRootPage()->getPointer()->getValue() ?>">
     <div id="contentInnerHolder">              
                   
         <?php if(App::getIns()->currentPage()->getPointer()->getValue()!='home') { ?>
                        <div id="breadCrumbsHolder">          
                              <div id="breadCrumbs">          
                                <nav>  
                                    <?php require App::getIns()->getLayoutTemplate('breadcumb') ?>
                                </nav>    
                              </div>
                         </div> <!-- breadCrumbsHolder -->
         <?php } ?>                
             
          
        <div id="content">
          <article>       
            
           <?php if(App::getIns()->currentPage()->getPointer()->getValue()!='home') { ?>  
            <h1><?php echo App::getIns()->currentPage()->getH1()->getValue(); ?></h1>    
           <?php } ?>                            
            
             <?php
                if( App::getIns()->currentPage()->getType()->getValue() == Page_Model::TYPE_SYSTEM )
                {
                    if( file_exists( APPLICATION_PATH .'/'. App::getIns()->getLangTemplateSrc() ) )                    
                    {
                        require_once App::getIns()->getLangTemplateSrc();
                    }
                    else {
                        require_once App::getIns()->getTemplateSrc();
                    }
                }
                else {
                     echo App::getIns()->currentPage()->getContent()->getValue();                    
                }
               ?>                                                            
           </article>                                     
        </div> <!-- content -->
            
           
     </div>                   
    <div class="clear"></div>
  </div> <!-- contentHolder -->
 </div>       
 </section>       
                                                                                                                         
  <footer>
       <div class="footerMenu">
         <div id="footerHolder">
           <div id="footer">

              <a id="footerCopy" href="http://www.designoshop.cz/" class="blank">DESIGNOSHOP</a>
              <div id="footerSocial">
                  <a id="facebookLink" href="https://www.facebook.com/pages/Designoshop/223118691035408" class="blank"></a>                  
                  <a id="pLink" href="http://www.pinterest.com/designoshop" class="blank"></a>                  
              </div> 
              <a id="footerNapiste" href="<?php echo App::getIns()->setLink('napiste'); ?>">Máte dotaz?<br />Napište nám</a>                                
              
              <a id="footerLogo" href="<?php echo Project::$WEB_URL; ?>"><span>www.designostudio.cz</span></a>
              <div class="clear"></div>
           </div>    
         </div> <!-- footerHolder -->
        </div>             
   </footer>                  
    
</div> <!-- holder -->            
    
           <?php if(App::getIns()->currentPage()->getPointer()->getValue()=='home') { ?>  
              <div id="homepage-modal" style="width:100%;heght:100%;z-index:20000;position:absolute;left:0px;top:0px;background-color:black;opacity:0.68;"><br></div>
              <div id="homepage-banner" style="z-index:20005;position:absolute;left:0px;top:75px;">
                <a id="homepage-banner-close" href="#" style="display:block;width:32px;height:38px;position:absolute;top:10px;right:13px;"></a>
                <img src="/assets/pages/home/images/150831_banner.png">
      		  </div>
           <?php } ?>        
      
            <!-- javascript  -->    
                    
                <script type="text/javascript" src="<?php echo Project::$WEB_URL; ?>/assets/libs/jquery/jquery-1.6.2.min.js"></script>
                <script type="text/javascript" src="<?php echo Project::$WEB_URL; ?>/assets/libs/jquery_ui/jquery-ui-1.8.16.custom.min.js"></script>
            
      
      
                
                <script type="text/javascript" src="<?php echo Project::$WEB_URL; ?>/assets/libs/jquery_form/jquery.form.js"></script>
                
                <script type="text/javascript" src="<?php echo Project::$WEB_URL; ?>/assets/libs/pfc_ui/ui.js"></script>

                <script type="text/javascript" src="<?php echo Project::$WEB_URL; ?>/assets/layouts/common/js/control.js"></script>
        
                <script type="text/javascript" src="<?php echo Project::$WEB_URL; ?>/assets/layouts/default/js/control.js"></script>

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

                 <?php if(App::getIns()->currentPage()->getPointer()->getValue()=='home') { ?>  
              <script>
                $(function(){
                  
                                  $("#homepage-modal").css('height',$(document).height());
                
                var pwidth = parseInt($("#homepage-banner").css('width')); 
                var wwidth = parseInt($(window).width());
                  console.log(pwidth);
                  console.log(wwidth);
                var pleft  = ""+(wwidth/2-pwidth/2)+"px";
                
                $("#homepage-banner").css('left',pleft);
                
                
                var pheight = parseInt($("#homepage-banner").css('height')); 
                var wheight = $(window).height();
                var ptop    = ""+(wheight/2-pheight/2)+"px";
                
                $("#homepage-banner").css('top',ptop);
                
                

                $("#homepage-banner-close").click(function(){
                  $("#homepage-banner").hide();
                  $("#homepage-modal").hide();
                });

                  
                })                
              </script>
           <?php } ?>  
      
<!-- 

    place for non-cached helpers 

    html body is closed by php
-->     
     
