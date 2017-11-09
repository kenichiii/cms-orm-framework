<?php

 
            //lets get html for page
                        $html = null;
       
                        $datatableCacheKey = 'admins-datatable';
                        $params = '?datatable=admins';
                        foreach($_POST as $key=>$v)
                          {
                            if(is_array($_POST[$key]))
                            {
                               $params .= '&'.$key.'[]='.implode('&'.$key.'[]=',$v);    
                            }
                            else $params .= '&'.$key.'='.$v;
                           }
                           
                        $datatableCacheKey .= md5($params);   
                           
                           
                            $html = __c()->get($datatableCacheKey);

                        
                            if($html == null) {
                              //if not page cached lets generate html 
                                ob_start();

    $data = new Admins_Datatable($_POST);
    //echo $data->getSelect();
   // echo $data->getJsFilters();
    echo $data->toHtml( App::getIns()->setAjaxLink("_curr",'admins-datatable'), true, false );


                                // GET HTML 
                                $html = ob_get_clean();
                               
                                    // Save to Cache 
                                    __c()->set($datatableCacheKey,$html, App::getIns()->currentPage()->getCacheLifeTime()->getValue());

                            }

                            //OUTPUT TEXT/HTML
                            echo $html;      