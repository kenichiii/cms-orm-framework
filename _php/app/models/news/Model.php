<?php

class News_Model extends Model_Model
{
    protected $_rawname = 'news';
    protected $_title = 'Novinka';
    
    protected $_gridClass = 'News_Grid';

    public function __construct()
    {        
    
        $this->modeladdPkId(); 
                     
          
        $this->modeladdDeleted(); 
                    
        
        $this->modeladdActive();
                
        
        $this->modeladdH1();
        
        $this->modeladdUri();        

        $this->modeladdDate();
        
        $this->modeladdPhoto();        
        
        $this->modeladdPerex();
               $this->get('perex')->setSanitize(false);         
        
        $this->modeladdContent();                                    
        


                                                                                     
        $gallery = new News_Gallery_Model();
        $this->relationsadd('gallery',$gallery->setN1('ownerid','id'));        
                       
                                        
    } //end __constructor

    
            /**
            *  load model by primary key from db table
            *
            * @return News_Model            
            **/            
            public static function loadByPK($id)
            {
                $model = new News_Model();
                return $model->getGrid(true)->getByPk($id);
            }   
                     
    
    
            /**
            *  load model by uri from db table
            *
            * @return News_Model
            
            **/            
            public static function loadByUri($uri)
            {
                $model = new News_Model();
                return $model->getGrid(true)->where(' and '.$model->getGrid()->getAlias('uri').'=%s',$uri)->getSingle();
            }     
                   
} //end class 


