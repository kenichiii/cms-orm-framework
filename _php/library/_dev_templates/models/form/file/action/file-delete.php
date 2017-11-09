[[
     
                    
        $model = <?php echo $modelclass ?>::loadByPK($_GET['id']);
                        
        $file = PUBLIC_PATH. '/'.$model->get('<?php echo $collum ?>')->getDir().'/'.$model->get('<?php echo $collum ?>')->getValue();
        
        unlink($file);        
        
        $model->set('<?php echo $collum; ?>','')->update();
        
        echo "done";
        
        __c()->clean();
