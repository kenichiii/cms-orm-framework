[[
     
     
    $file = $_FILES['file'];
    if ($_FILES["file"]["error"] > 0)
    {
        echo "Error ".($_FILES["file"]["error"]==1)?'Vložený soubor je příliš velký':$_FILES["file"]["error"];
    }                 
    else {
            $owner = <?php echo $modelclass ?>::loadByPK($_GET['id']);

     if($owner->get('<?php echo $collum ?>')->isValidFile($file['name'])) {    
     
            $tempFile = $file['tmp_name'];

        $targetPath = PUBLIC_PATH. '/'.$owner->get('<?php echo $collum ?>')->getDir().'/';

         if(!is_dir($targetPath))
            {
            mkdir($targetPath,0777,true);
            }
                    
        
        $pies = explode('.',$file['name']);    
        $ext = strtolower(end($pies));    
        $fileName = $_GET['id'].'_'. parse_seo_title($file['name']) .'_'.time().'.'.$ext;
        $targetFile =  str_replace('//','/',$targetPath) . $fileName;

       if( ! move_uploaded_file($tempFile,$targetFile) )
       {
         //   echo "NOT MOVED TO: $targetFile";
            echo "Nepodařilo se přesunout soubor";
            exit;
       }
        else {

        $owner->set('<?php echo $collum; ?>',$fileName)->update();
        
        echo "done";
        
        __c()->clean();
        }
     }
     else
     echo "Neplatná přípona souboru";
   }  
