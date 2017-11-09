<?php

    $uri = App::getIns()->getParam( App::getIns()->currentPage()->getUri()->getValue() );

        $bean  = HPZnacky_Model::loadByUri($uri);

            $pagetree = App::getIns()->getPageTree();
            $lastindex = count($pagetree)-1;

        if($bean instanceof HPZnacky_Model && $bean->getDeleted()->getValue()==0  && $bean->getActive()->getValue() ) 
        {
            //change title of page
            App::getIns()->setPageTreePage($lastindex,'h1',$bean->getH1()->getValue()); 
            //change breadcumb
            App::getIns()->setPageTreePage($lastindex,'menuname',$bean->getH1()->getValue());                
            
            
            //find galleries
            $pagesGrid = new Page_Grid();
            $galleries = $pagesGrid->setActiveCond()->setDeletedCond()
                    ->andWhere( $pagesGrid->getAlias('pointer')." like %s", $bean->get('uri')->getValue().'%' )
                    ->setRankOrderByCond('DESC')
                ->getData();    
            
           if(count($galleries)==1)
           {
               reloadPage(App::getIns()->setLink($galleries[0]->getPointer()->getValue()));
               exit;
               
               
           }
             
             
            //add javascripts
            App::getIns()->addFileJs(Project::$WEB_URL.'/assets/libs/pfc_ui/autofillscreengallery.js');
            App::getIns()->addFilePhpJs( App::getIns()->setPjsLink('_curr', 'galleries',array('znacka'=>$uri) ));
            
            
        }
        else {        
            $notfound = true;
            App::getIns()->setPageTreePage($lastindex,'h1','Error 404'); 
            App::getIns()->setPageTreePage($lastindex,'menuname','Error 404');                            
        }
