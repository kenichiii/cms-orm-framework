<?php

class Napiste_Model extends Model_Model
{
    protected $_rawname = 'zprava';
    protected $_title = 'Zpráva';
    
    protected $_gridClass = 'Napiste_Grid';

    public function __construct()
    {        
    
        $this->modeladdPkId(); 
                     
          
        $this->modeladdDeleted(); 
                    
     
                        
        
        $this->_model ['jmeno']= new Model_Primitive_Varchar();
        $this->_model ['jmeno']->setName('jmeno')->setTitle('Jméno')        
                            ->setNotNull(true);

                                                                     
        
        $this->_model ['email']= new Model_Extended_Email();
        $this->_model ['email']->setName('email')->setTitle('Email')        
                            ->setNotNull(true);

                                                                     
        
        $this->_model ['telefon']= new Model_Extended_PhoneNumber();
        $this->_model ['telefon']->setName('telefon')->setTitle('Telefon')        
                            ;

                                                                     
        
        $this->_model ['zprava']= new Model_Extended_SafeRichText();
        $this->_model ['zprava']->setName('zprava')->setTitle('Zpráva')        
                            ->setNotNull(true);


        $this->_model ['created']= new Model_Primitive_Datetime();
        $this->_model ['created']->setName('created')->setTitle('Zaslána')        
                            ->setNotNull(true);
                                                                     
                       
                                        
    } //end __constructor

    
            /**
            *  load model by primary key from db table
            *
            * @return Napiste_Model            
            **/            
            public static function loadByPK($id)
            {
                $model = new Napiste_Model();
                return $model->getGrid(true)->getByPk($id);
            }   
                     
    
    
   


            
            
            
            
    
    
   


            
            
            
            
    
                
} //end class 


