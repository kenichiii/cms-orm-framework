<?php

  
 $id = $_GET['id'];
 $id = intval( str_replace('photo_', '', $id) );
 
 try{
 
            $ownerid = $_GET['ownerid'];
            $owner = Page_Model::loadByPK($ownerid);     
            
            
        if( $owner->getGallery()->deleteItem($id) )
        {                     
          $owner->set('lastupdate',date('Y-m-d G:i:s'))->update();        
         
           echo "Obrázek byl smazán";        
           __c()->clean();
        }
        else echo "error";
   }
   catch(Exception $e)
   {
        errorException($e);
        echo "error {$e->getMessage()}";
   }