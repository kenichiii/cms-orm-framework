[[

    $succ = 'no';
    $err  = array();
    
    try
     {
     
        $model = <?php echo $formedit->getModelClass() ?>::loadByPK($_POST['id']);
        
        if(! $model instanceof <?php echo $formedit->getModelClass() ?>)
        { throw new Exception('not-valid-id'); }
        
        $model->fromform($_POST);
        
                                                                 
        $val = $model->validate(Model_Form::ACTION_EDIT,$_POST,$model);                                              
                
        
        if($val->isSucc())
        {
            $model->update();                        
            $succ = 'yes';
            __c()->clean();
        }
        else        
        $err = $val->getErrors();
        
     }
     catch(Exception $e) 
     {        
        errorException($e);
        $err[]= array( 'el' => 'exception','mess'=>'Došlo k nečekanému běhu aplikace. Vaše akce nemohla být přijata.','type'=>'exception');        
     }
     
     
        echo json_encode(array(
                'succ' => $succ,
                'id' => $_POST['id'],
                "succMsg"=>"Vaše údaje byly v pořádku uloženy",
                'errors' => $err
            ));
        
  

