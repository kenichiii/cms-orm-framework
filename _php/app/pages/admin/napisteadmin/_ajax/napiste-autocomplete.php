<?php


            //lets get json response
                        $json = null;
       
                            $json = __c()->get(App::getIns()->getCurrentCacheKey());

                        
                            if($json == null) {
                              //if not page cached lets generate html 
                                ob_start();

    $return = array();

    $collum = $_GET['collum'];
    $part   = $_GET['value'];
try
{
    $data = new Napiste_Datatable(array(
     'limit' => 0,
     'per_page' => 15,
     'sortingCol' => $collum,
     'sorting' => "ASC",
     $collum => $part,
     "mode" => Model_Component_Datatable_dataGrid::MODE_AUTOCOMPLETE,
    ), false);

    foreach( $data as $val )
    {
        $return []= $val->$collum;
    }
}
catch(Exception $e)
{
    $return []= "error!";
}
    echo json_encode($return);
    
                                // GET HTML 
                                $json = ob_get_clean();
                               
                                    // Save to Cache 
                                    __c()->set(App::getIns()->getCurrentCacheKey(),$json, App::getIns()->currentPage()->getCacheLifeTime()->getValue());

                            }

                            //OUTPUT TEXT/JSON
                            echo $json;        