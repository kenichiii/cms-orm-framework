<?php

try {

    $model = User_Model::loadByPK($_GET['id']);
    
    $deletedlogin = $model->getLogin()->getValue().'-deleted-'.time();
    $deletedemail = $model->getEmail()->getValue().'-deleted-'.time();
    
    $model->set('login',$deletedlogin);
    $model->set('email',$deletedemail);
    $model->set('deleted',1);
    $val = $model->validate(Model_Form::ACTION_EDIT,array('id'=>$_GET['id'],'email'=>$deletedemail,'login'=>$deletedlogin));
    if($val->isSucc())
    {
        $model->update();
        __c()->clean();
        echo "Položka byla v pořádku smazána";
    }
    else  echo "error";
    
} catch (Exception $ex) {
    echo "error ".$ex->getMessage();
}
