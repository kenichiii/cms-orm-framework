<?php
     
     
        $file = $_FILES['photo'];
                    
            $owner = Znacky_Model::loadByPK($_GET['id']);

            $tempFile = $file['tmp_name'];

        $targetPath = PUBLIC_PATH. '/'.$owner->get('photo')->getDir().'/';
        $cachePath = str_replace('/docs/','/docs/_cache/img/',$targetPath);
         if(!is_dir($targetPath))
            {
            mkdir($targetPath,0777,true);
            }
                    
         if(!is_dir($cachePath))  
          {
                mkdir($cachePath,0777,true);
            }

        
        $pies = explode('.',$file['name']);    
        $ext = strtolower(end($pies));    
        $fileName = $_GET['id'].'_'. parse_seo_title($file['name']) .'_'.time().'.'.$ext;
        $targetFile =  str_replace('//','/',$targetPath) . $fileName;

       if( ! move_uploaded_file($tempFile,$targetFile) )
       {
            echo "NOT MOVED TO: $targetFile";
            exit;
       }
        else {
        
        $owner->set('photo',$fileName)->update();
        
        echo "done";
        
        __c()->clean();
        }
        
