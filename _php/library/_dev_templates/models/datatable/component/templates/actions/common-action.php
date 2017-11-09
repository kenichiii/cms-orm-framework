[[

    $succ = 'no';
    $err  = array();
    
    try
     {

 $selected = strpos($_GET['selected'],',') > 0 ? explode(',', $_GET['selected']) : array( intval($_GET['selected']) );
    
 foreach( $selected as $key => $id)
 {

 }

 
      }
     catch(Exception $e) 
     {        
        errorException($e);
        $err[]= array( 'el' => 'exception','mess'=>'Došlo k nečekanému běhu aplikace. Vaše akce nemohla být přijata.','type'=>'exception');        
     }
     
     
        echo json_encode(array(
                'succ' => $succ,
                'selected' => $_GET['selected'],
                "succMsg"=>"Vaše údaje byly v pořádku uloženy",
                'errors' => $err
            ));