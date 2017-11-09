<?php
     
     
        $file = $_FILES['photos'];
        
        //var_dump($_FILES['photos']);
    
            $ownerid = $_GET['id'];
            $owner = Page_Model::loadByPK($ownerid);

            $rank = $owner->getGallery()->getMaxRank($ownerid);
            $rank++;

            $dbId = $owner->getGallery()->insert(array('ownerid'=>$ownerid,'rank'=>$rank));
            
            $tempFile = $file['tmp_name'][0];

        $targetPath = $owner->getGallery()->getDir().'/';
        
         if(!is_dir($targetPath))
            {
            mkdir($targetPath,0777,true);
            }
                    
      
        
        $pies = explode('.',$file['name'][0]);    
        $ext = strtolower(end($pies));    
        $fileName = $ownerid.'_'.$dbId.'_'. parse_seo_title($file['name'][0]) .'_'.time().'.'.$ext;
        $targetFile =  str_replace('//','/',$targetPath) . $fileName;

       if( ! move_uploaded_file($tempFile,$targetFile) )
       {
            echo "NOT MOVED TO: $targetFile";
            exit;
       }
        else {
        
        $owner->getGallery()->updateByPk(array('src'=>$fileName,'h1'=>$file['name'][0]),$dbId);

              $owner->set('lastupdate',date('Y-m-d G:i:s'))->update();        
         
        
        echo "done";
        
        __c()->clean();
        }
        
