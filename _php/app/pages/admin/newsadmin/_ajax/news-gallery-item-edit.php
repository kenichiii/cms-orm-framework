<?php
            //lets get html for page
                        $html = null;

                            $html = __c()->get(App::getIns()->getCurrentCacheKey());

                            if($html == null) {
                              //if not page cached lets generate html 
                                ob_start();

    $id = $_GET['id'];

    if(is_numeric($id))
    {

        $owner  = new News_Model();
        $bean = $owner->getGallery()->getByPk($id);                
        if($bean instanceof Model_Component_Gallery_Model) 
        {

            //

        }
        else $nenalezenoId = true;
    }
    else $nenalezenoId = true;

    require_once '_templates/template.news.gallery.form.item.edit.php';

                                // GET HTML 
                                $html = ob_get_clean();

                                    // Save to Cache 
                                    __c()->set(App::getIns()->getCurrentCacheKey(),$html, App::getIns()->currentPage()->getCacheLifeTime()->getValue());

                            } //end if html==null

                            //OUTPUT TEXT/HTML
                            echo $html;                                                                                                                                                                                                                                                                                                

 ?>      