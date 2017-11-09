<?php

            //lets get json response
                        $json = null;
       
                            $json = __c()->get(App::getIns()->getCurrentCacheKey());

                        
                            if($json == null) {
                              //if not page cached lets generate html 
                                ob_start();

$parentid = isset($_REQUEST['id'])?$_REQUEST['id']:0;
$lang = isset($_REQUEST['lang'])?$_REQUEST['lang']:'cz';


$pagesGrid = new Page_Grid();
                
        $pagesGrid->setDeletedCond()
                  ->where(' and '.$pagesGrid->getAlias('parentid').'=%i',$parentid)
                  ->where(' and ( '.$pagesGrid->getAlias('lang').'=%s or '.$pagesGrid->getAlias('lang')."='uni' )",$lang)
                  ->orderBy($pagesGrid->getAlias('rank').' ASC');  
 
 $return = array();       
 foreach($pagesGrid->getData() as $key=>$page)
 {
            $obj = new stdClass();
            $attr = new stdClass();
            $attr->id = 'node_'.$page->getId()->getValue();
            $attr->rel = 'page';
            $obj->attr = $attr;
            $obj->data = $page->getMenuName()->getValue();
            $obj->state = 'closed';
            $return []= $obj;
        }
            
        echo json_encode($return);
        
                                // GET HTML 
                                $json = ob_get_clean();
                               
                                    // Save to Cache 
                                    __c()->set(App::getIns()->getCurrentCacheKey(),$json, App::getIns()->currentPage()->getCacheLifeTime()->getValue());

                            }

                            //OUTPUT TEXT/JSON
                            echo $json;          