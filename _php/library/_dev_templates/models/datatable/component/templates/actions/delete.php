[[

    $succ = 'no';
    $err  = array();

 try
  {
    $id = $_GET['id'];

<?php 
if($modelModel->isDeletedAble()) {
?>
    $model = <?php echo $modelModelClass ?>::loadByPK($_GET['id']);     
    $model->set('deleted',1)->update();
    __c()->clean();

    $succ = "yes";
     
<?php } else { ?>

    $model = <?php echo $modelModelClass ?>::loadByPK($_GET['id']);
    $model->delete();
    __c()->clean();
    
    $succ = "yes";
<?php } ?>         
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

