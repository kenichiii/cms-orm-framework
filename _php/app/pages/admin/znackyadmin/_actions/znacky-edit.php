<?php

    $succ = 'no';
    $err  = array();
    
    try
     {
     
        $model = Znacky_Model::loadByPK($_POST['id']);
        
        if(! $model instanceof Znacky_Model)
        { throw new Exception('not-valid-id'); }
        
        $model->fromform($_POST);
        
        $model->set('deleted',(isset($_POST['deleted'])?1:0));
        $model->set('active',(isset($_POST['active'])?1:0));
                                                           
        
        $val = $model->validate(Model_Form::ACTION_EDIT,$_POST);                                              
                
        
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
                'errors' => $err
            ));
        
            

