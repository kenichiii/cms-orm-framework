<?php

try{

 $id = $_POST['pageId'];
 $model = Page_Model::loadById($id);
 $model->set('deleted',1)->set('pointer',$model->getPointer()->getValue().'-deleted-'.time())
    ->set('lastupdate',date('Y-m-d G:i:s'))
   ->update();     
 
           echo "Stránka byla smazána";        
           __c()->clean();
   }
   catch(Exception $e)
   {
        errorException($e);
        echo "error - ".$e->getMessage();
   }