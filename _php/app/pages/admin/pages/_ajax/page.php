<?php
 
 
            //lets get html for page
                        $html = null;
       
                            $html = __c()->get(App::getIns()->getCurrentCacheKey());

                        
                            if($html == null) {
                              //if not page cached lets generate html 
                                ob_start();
                                
$grid = new Page_Grid();
$bean = $grid->getByPk($_GET['id']);

if(!$bean instanceof Page_Model) { echo 'NEPLATNE PAGE ID'; }
else {
     require_once '_templates/form.page.php';
}

                                // GET HTML 
                                $html = ob_get_clean();
                               
                                    // Save to Cache 
                                    __c()->set(App::getIns()->getCurrentCacheKey(),$html, App::getIns()->currentPage()->getCacheLifeTime()->getValue());

                            }

                            //OUTPUT TEXT/HTML
                            echo $html;                                                                                                                                                                                                                                                                                                


 ?>