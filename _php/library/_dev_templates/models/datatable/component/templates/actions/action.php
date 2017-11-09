[[
 
//datatable action file

    $succ = 'no';
    $err  = array();
    
    try
     {
     
<?php if($modelModelClass != '') { ?>
     
        $model = <?php echo $modelModelClass; ?>::loadByPK($_POST['id']);
        
        if(! $model instanceof <?php echo $modelModelClass; ?>)
        { throw new Exception('not-valid-id'); }
                

         $val = $model->validate(Model_Form::ACTION_EDIT,$_POST,$model);                                              
                
        
                    if($val->isSucc())
                    {
                        $model->update();                        
                        $succ = 'yes';
                        __c()->clean();
                    }
                    else        
                    $err = $val->getErrors();
                    
<?php } ?>
                    
     }
     catch(Exception $e) 
     {        
        errorException($e);
        $err[]= array( 'el' => 'exception','mess'=>'Došlo k nečekanému běhu aplikace. Vaše akce nemohla být přijata.','type'=>'exception');        
     }
     
     
        echo json_encode(array(
                'succ' => $succ,
<?php if($modelModelClass != '') { ?>                'id' => $_POST['id'],<?php } ?>
                "succMsg"=>"Vaše údaje byly v pořádku uloženy",
                'errors' => $err
            ));
            
            