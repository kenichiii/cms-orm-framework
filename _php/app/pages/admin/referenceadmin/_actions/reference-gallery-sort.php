<?php

  try{        
            $ownerid = $_GET['ownerid'];
            $owner = Reference_Model::loadByPK($ownerid);

       if( $owner->getGallery()->updateSort($_GET['photo'], $_GET['neib']) )
        {           

          $photomodel = $owner->getGallery()->getByPK(str_replace('photo_','',$_GET['photo']));
          $neibmodel = $owner->getGallery()->getByPK(str_replace('photo_','',$_GET['neib']));

          $photomodel->set('lastupdate',date('Y-m-d G:i:s'))->update();
          $neibmodel->set('lastupdate',date('Y-m-d G:i:s'))->update();

           echo "Obrázek byl přesunut";  
           __c()->clean();
        }
        else echo "error";
   }
   catch(Exception $e)
   {
        errorException($e);
        echo "error";
   }
