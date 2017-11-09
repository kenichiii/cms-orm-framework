<?php

 $id = $_GET['id'];
 $id = intval( str_replace('photo_', '', $id) );

 try{

            $ownerid = $_GET['ownerid'];
            $owner = News_Model::loadByPK($ownerid);     

        if( $owner->getGallery()->deleteItem($id) )
        {                     

           echo "Obrázek byl smazán";        
           __c()->clean();
        }
        else echo "error";
   }
   catch(Exception $e)
   {
        errorException($e);
        echo "error";
   }