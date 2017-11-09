<?php

try {

    $model = HPBanner_Model::loadByPK($_GET['id']);
    $model->set('deleted',1)->update();
    __c()->clean();
    echo "done";
} catch (Exception $ex) {
    echo "error";
}


