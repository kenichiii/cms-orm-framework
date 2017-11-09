<?php
     
                    
        $model = Page_Model::loadByPK($_GET['id']);
                        
        $file = PUBLIC_PATH. '/'.$model->get('photo')->getDir().'/'.$model->get('photo')->getValue();
        
        unlink($file);        
        
                $model->set('lastupdate',date('Y-m-d G:i:s'));
                
        $model->set('photo','')->update();
        
        echo "done";
        
        __c()->clean();
