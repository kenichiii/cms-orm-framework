<?php
     

     $id = 0;
     $succ = 'no';
     $err  = array();
     
     try {

        $model = new News_Model();
        
        $model->fromform($_POST);
        

        $model->set('active',(isset($_POST['active'])?1:0));
           
        
        
        $val = $model->validate(Model_Form::ACTION_NEW);
                                                                                                                                
        if($val->isSucc())
        {
            $id = $model->insert();                        
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
                'id' => $id,
                'errors' => $err
            ));
        
            