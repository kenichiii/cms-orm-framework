<?php

try {

    App::connectDatabase();

    require_once '_dev_templates/_system-install/install-basic-database.php';

    __c()->clean();

} catch(Exception $e) {
    echo $e->getMessage();
    echo " | ";
    echo dibi::$sql;
}

