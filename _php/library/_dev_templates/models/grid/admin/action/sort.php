[[

    $succ = 'no';
    $err  = array();

  try
  {
  
    <?php echo $class; ?>::transactionStart();
  
    $id = $_GET['id'];

    $model = <?php echo $modelModelClass ?>::loadByPK($_GET['id']);
    $model->moveAfterAction($_GET['neib']);
    
    <?php echo $class; ?>::transactionCommit();
    
    __c()->clean();
    
    $succ = "yes";

   }
     catch(Exception $e) 
     {        
        <?php echo $class; ?>::transactionRollback();
        errorException($e);
        $err[]= array( 'el' => 'exception','mess'=>'Došlo k nečekanému běhu aplikace. Vaše akce nemohla být přijata.','type'=>'exception');        
     }
     
     
        echo json_encode(array(
                'succ' => $succ,
                'id' => $_GET['id'],
                "succMsg"=>"Položka byla v pořádku přesunuta",
                'errors' => $err
            ));


