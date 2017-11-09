<?php

    $succ = 'no';
    $err  = array();
    
    try
     {
     
        $model = Page_Model::loadById($_POST['id']);
        
        if(! $model instanceof Page_Model)
        { throw new Exception('not-valid-id'); }
        
        $model->fromform($_POST);
        if(!isset($_POST['showinmenu'])) $model->set('showinmenu',0);
        if(!isset($_POST['footermenu'])) $model->set('footermenu',0);
        if(!isset($_POST['active'])) $model->set('active',0);
        $model->set('lastupdate',date('Y-m-d G:i:s'));
        
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
        

