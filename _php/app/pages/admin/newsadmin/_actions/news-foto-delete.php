<?php
     
                    
        $model = News_Model::loadByPK($_GET['id']);

        $file = PUBLIC_PATH. '/'.$model->get('photo')->getDir().'/'.$model->get('photo')->getValue();
        
        unlink($file);        
        
        $model->set('photo','')->update();
        
        echo "done";
        
        __c()->clean();
