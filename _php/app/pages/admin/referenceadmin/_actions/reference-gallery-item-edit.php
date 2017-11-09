<?php

    $succ = 'no';
    $err  = array();

    try
     {
        $id = $_POST['id'];

            $ownerid = $_POST['ownerid'];
            $owner = Reference_Model::loadByPK($ownerid);

        $model = $owner->getGallery()->getByPk($id); 

        if(! $model instanceof Model_Component_Gallery_Model)
        { throw new Exception('not-valid-id'); }

        $model->fromform($_POST);

        $val = $model->validate(Model_Form::ACTION_EDIT,$_POST);                                              

        if($val->isSucc())
        {
            $model->set('lastupdate',date('Y-m-d G:i:s'))->update();

            $succ = 'yes';
            __c()->clean();
        }
        else        
            $err = $val->getErrors();

     }
     catch(Exception $e) 
     {   
        errorException($e);
        $err[]= array( 'el' => 'exception','mess'=>'Došlo k nečekanému běhu aplikace. Vaše akce nemohla být přijata.'.$e->getMessage(),'type'=>'exception');        
     }

        echo json_encode(array(
                'succ' => $succ,
                'id' => $_POST['id'],
                'errors' => $err
            ));

        