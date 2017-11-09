<?php

class News_Gallery_Model extends Model_Component_Gallery_Model 
{
    
    protected $_gridClass = 'News_Gallery_Grid';
    
    
           /**
            *  load model by primary key from db table
            *
            * @return News_Gallery_Model            **/            
            public static function loadByPK($id)
            {
                $model = new News_Gallery_Model();
                return $model->getGrid(true)->getByPk($id);
            }     
    
}