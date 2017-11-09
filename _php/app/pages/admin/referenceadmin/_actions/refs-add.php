<?php

     $id = 0;
     $succ = 'no';
     $err  = array();

     try {

        $model = new Reference_Model();

        $model->fromform($_POST);

        $model->setRank();

        $val = $model->validate(Model_Form::ACTION_NEW,$_POST,$model);

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
                "succMsg"=>"Vaše údaje byly v pořádku vloženy",
                'errors' => $err
            ));

            