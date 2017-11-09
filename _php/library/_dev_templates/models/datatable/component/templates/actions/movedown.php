[[
 
    $succ = 'no';
    $err  = array();

 try
  {
  
    <?php echo $modelModel->getGridClassName() ?>::transactionStart();
  
    $id = $_GET['id'];
            
    $model = <?php echo $modelModelClass ?>::loadByPK($id);
    $model->moveDownAction();
    
    <?php echo $modelModel->getGridClassName() ?>::transactionCommit();
    
        __c()->clean();
        
      $succ = "yes";
   }
     catch(Exception $e) 
     {        
        <?php echo $modelModel->getGridClassName() ?>::transactionRollback();
        errorException($e);
        $err[]= array( 'el' => 'exception','mess'=>'Došlo k nečekanému běhu aplikace. Vaše akce nemohla být přijata.','type'=>'exception');        
     }
     
     
        echo json_encode(array(
                'succ' => $succ,
                'id' => $_GET['id'],
                "succMsg"=>"Položka byla v pořádku přesunuta dolů",
                'errors' => $err
            ));

    
    
    

