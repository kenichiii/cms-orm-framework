<?php

class Znacky_Model extends Model_Model
{
    protected $_rawname = 'znacky';
    protected $_title = 'Značky';
    
    protected $_gridClass = 'Znacky_Grid';

    public function __construct()
    {        
    
        $this->modeladdPkId(); 
                     
          
        $this->modeladdDeleted(); 
                    
        
        $this->modeladdActive();
                
        
        $this->modeladdH1();
        
        
        $this->modeladdPhoto();
        
     
                        
        
        $this->_model ['link']= new Model_Primitive_Varchar();
        $this->_model ['link']->setName('link')->setTitle('Odkaz')        
                            ;

                                                                     
                       
                                        
    } //end __constructor

    
            /**
            *  load model by primary key from db table
            *
            * @return Znacky_Model            
            **/            
            public static function loadByPK($id)
            {
                $model = new Znacky_Model();
                return $model->getGrid(true)->getByPk($id);
            }   
                     
    
    
   


            
            
            
            
    
    
   


            
            
            
            
    
    
   


            
            
            
            
    
    
   


            
            
            
            
    
    
   


            
            
            
            
    
                
} //end class 


