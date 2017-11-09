<?php

    $succ = 'no';
    $err  = array();

 try
  {
    $id = $_GET['id'];

    $model = Reference_Model::loadByPK($_GET['id']);     
    $model->set('deleted',1)->update();
    __c()->clean();

    $succ = "yes";

   }
     catch(Exception $e) 
     {        
        errorException($e);
        $err[]= array( 'el' => 'exception','mess'=>'Došlo k nečekanému běhu aplikace. Vaše akce nemohla být přijata.','type'=>'exception');        
     }

        echo json_encode(array(
                'succ' => $succ,
                'id' => $_GET['id'],
                "succMsg"=>"Položka byla v pořádku smazána",
                'errors' => $err
            ));

