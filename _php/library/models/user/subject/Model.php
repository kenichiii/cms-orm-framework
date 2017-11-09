<?php

class User_Subject_Model extends Model_Model
{
    protected $_title = 'Subjekt';
    protected $_rawname = 'subject';
    protected $_gridClass = 'User_Subject_Grid';
    
    public function __construct()
    {        
        $this->modeladdPkId();

        $this->modeladdH1();     
        
        $this->modeladdActive();    
        
        $this->modeladdDeleted();    
        
        $this->modeladdCreated();
        
        $this->modeladdLastupdate();        
    }    
     
             /**
            *  load model by primary key from db table
            *
            * @return User_Subject_Model            
            **/            
            public static function loadByPK($id)
            {
                $model = new User_Subject_Model();
                return $model->getGrid()->getByPk($id);
            }  
}
