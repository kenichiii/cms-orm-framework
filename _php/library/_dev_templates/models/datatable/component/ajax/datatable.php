[[

 
            //lets get html for page
                        $html = null;
       
                        $datatableCacheKey = '<?php echo $model->getHtmlID(); ?>-datatable';
                        $params = '?datatable=1';
                        foreach($_POST as $key=>$v)
                          {
                            if(is_array($_POST[$key]))
                            {
                               $params .= '&amp;'.$key.'[]='.implode('&amp;'.$key.'[]=',$v);    
                            }
                            else $params .= '&amp;'.$key.'='.$v;
                           }
                           
                        $datatableCacheKey .= md5($params);   
                           
                           
                            $html = __c()->get($datatableCacheKey);

                        
                            if($html == null) {
                              //if not page cached lets generate html 
                                ob_start();

    $data = new <?php echo $modelclass; ?>($_POST);
    //echo $data->getSelect();
   // echo $data->getJsFilters();
    echo $data->toHtml( App::getIns()->setAjaxLink("_curr",'<?php echo $model->getHtmlID(); ?>-datatable'), <?php echo $hasActionNew ? 'true':'false';?>, <?php echo count($model->getGroupActions()) ? 'true':'false';?> );


                                // GET HTML 
                                $html = ob_get_clean();
                               
                                    // Save to Cache 
                                    __c()->set($datatableCacheKey,$html, App::getIns()->currentPage()->getCacheLifeTime()->getValue());

                            }

                            //OUTPUT TEXT/HTML
                            echo $html;      