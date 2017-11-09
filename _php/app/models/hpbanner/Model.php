<?php

class HPBanner_Model extends Model_Model
{
    protected $_rawname = 'homebanner';
    protected $_title = 'Home banner';
    
    protected $_gridClass = 'HPBanner_Grid';

    public function __construct()
    {        
    
        $this->modeladdPkId(); 
                     
          
        $this->modeladdDeleted(); 
                    
        
        $this->modeladdActive();
                
        
        $this->modeladdH1();
        $this->_model ['h1']->setSanitize(false);
        
                $this->modeladdPhoto();
        
        
        $this->modeladdRank();
        
        
        
        
        $this->_model ['link']= new Model_Primitive_Varchar();
        $this->_model ['link']->setName('link')->setTitle('Odkaz')  
                ->setNotNull(true)
                            ;

                                                                     
                                        
    } //end __constructor

            
            /**
            *   set rank to max+1 
            *
            * @return HPBanner_Model            **/            
            public function setRank()
            {
              $this->set('rank',(HPBanner_Grid::getConn()->fetchSingle("select max(rank) from ".$this->getGrid(true)->getTableRaw())+1));
              return $this;
            }            
            
            
           /**
            *  load model by primary key from db table
            *
            * @return HPBanner_Model
            **/            
            public static function loadByPK($id)
            {
                $model = new HPBanner_Model();
                return $model->getGrid(true)->getByPk($id);
            }              
    
                
} //end class 


