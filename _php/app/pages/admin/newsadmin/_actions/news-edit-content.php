<?php

    $succ = 'no';
    $err  = array();
    
    try
     {
     
        $model = News_Model::loadByPK($_POST['id']);
        
        if(! $model instanceof News_Model)
        { throw new Exception('not-valid-id'); }
        
        $model->fromform($_POST);        
                                                           
        
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
        $err[]= array( 'el' => 'exception','mess'=>'Došlo k nečekanému běhu aplikace. Vaše akce nemohla být přijata. '.$e->getMessage(),'type'=>'exception');        
     }
     
     
        echo json_encode(array(
                'succ' => $succ,
                'id' => $_POST['id'],
                'errors' => $err
            ));
        
            

