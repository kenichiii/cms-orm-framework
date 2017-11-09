<?php

try {

$model = new Settings_Model();
$model->set('pointer',$_POST['pointer'])->set('h1',$_POST['h1'])
      ->set('type', $_POST['type'])->set('section',$_POST['section'])  
      ->set($_POST['type'],$_POST['value'])->set('lang',$_POST['lang'])  
   ->insert();

    echo "done";

} catch(Exception $e)
{
    echo $e->getMessage();
}