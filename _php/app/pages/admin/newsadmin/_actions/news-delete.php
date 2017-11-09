<?php

try {

    $model = News_Model::loadByPK($_GET['id']);
    $model->set('deleted',1)->update();
    __c()->clean();
    echo "Novinka byla v pořádku smazána";
} catch (Exception $ex) {
    echo "error";
}
