<?php

    $succ = 'no';
    $err  = array();

 try
  {
    HPZnacky_Grid::transactionStart();

    $id = $_GET['id'];

    $model = HPZnacky_Model::loadByPK($id);
    $model->moveUpAction();

    HPZnacky_Grid::transactionCommit();

        __c()->clean();

      $succ = "yes";
   }
     catch(Exception $e) 
     {        
        HPZnacky_Grid::transactionRollback();
        errorException($e);
        $err[]= array( 'el' => 'exception','mess'=>'Došlo k nečekanému běhu aplikace. Vaše akce nemohla být přijata.','type'=>'exception');        
     }

        echo json_encode(array(
                'succ' => $succ,
                'id' => $_GET['id'],
                "succMsg"=>"Položka byla v pořádku přesunuta nahoru",
                'errors' => $err
            ));

    