<?php

    $succ = 'no';
    $err  = array();
    
    try
     {
     
        $model = User_Model::loadByPK($_POST['id']);
        
        if(! $model instanceof User_Model)
        { throw new Exception('not-valid-id'); }
        

        
        $model->fromform($_POST);
                                                                                   
        
        $val = $model->validate(Model_Form::ACTION_EDIT,$_POST);                                              
        
        //echo $model->getFullname()->getFirstname()->getCollum();
        
        if($val->isSucc())
        {
            $model->update();    
            
            $urgrid = new User_Roles_Grid();
            User_Roles_Grid::getConn()->query('UPDATE '.$urgrid->getTableRaw().' SET subroleid=%i WHERE roleid=%i AND userid=%i'
                         ,intval($_POST['subrole']),AppUserRoles::getIns()->getRole("admin")->getId()->getValue(),$_POST['id']);
            
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
        
            

