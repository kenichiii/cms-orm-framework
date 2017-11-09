<?php

try {

    $model = Napiste_Model::loadByPK($_GET['id']);
    $model->set('deleted',1)->update();
    __c()->clean();
    echo "Položka byla v pořádku smazána";
} catch (Exception $ex) {
    echo "error";
}
