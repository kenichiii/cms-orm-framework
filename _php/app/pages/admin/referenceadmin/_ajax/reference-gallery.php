<?php

            //lets get html for page
                        $html = null;

                            $html = __c()->get(App::getIns()->getCurrentCacheKey());

                            if($html == null) {
                              //if not page cached lets generate html 
                                ob_start();

    if(isset($_GET['id']))
    {
        $bean = Reference_Model::loadByPK($_GET['id']);
    }

    $gallery = $bean->getGallery()->orderBy('rank desc')->getData();

    require_once '_templates/reference.gallery.list.php';

    // GET HTML 
                                $html = ob_get_clean();

                                    // Save to Cache 
                                    __c()->set(App::getIns()->getCurrentCacheKey(),$html, App::getIns()->currentPage()->getCacheLifeTime()->getValue());

                            }

                            //OUTPUT TEXT/HTML
                            echo $html;                                                                                                                                                                                                                                                                                                

 ?>