<?php

    $uri = App::getIns()->getParam( App::getIns()->currentPage()->getUri()->getValue() );

        $bean  = Reference_Model::loadByUri($uri);

            $pagetree = App::getIns()->getPageTree();
            $lastindex = count($pagetree)-1;

        if($bean instanceof Reference_Model && $bean->getDeleted()->getValue()==0  && $bean->getActive()->getValue() ) 
        {
            //change title of page
            App::getIns()->setPageTreePage($lastindex,'h1',$bean->getH1()->getValue()); 
            //change breadcumb
            App::getIns()->setPageTreePage($lastindex,'menuname',$bean->getH1()->getValue());                

        }
        else {        
            $notfound = true;
            App::getIns()->setPageTreePage($lastindex,'h1','Error 404'); 
            App::getIns()->setPageTreePage($lastindex,'menuname','Error 404');                            
        }

