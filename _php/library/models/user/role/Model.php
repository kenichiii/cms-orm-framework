<?php

class User_Role_Model extends Model_Model
{
        protected $_title = 'Uživatelské role';
    protected $_rawname = 'userroles';
    protected $_gridClass = 'User_Role_Grid';
    
    public function __construct()
    {        
        $this->modeladdPkId();

        $this->_model ['pointer']= new Model_Primitive_Varchar();
        $this->_model ['pointer']->setTitle('Role')->setName('role')
                               ->setUnique(true);        
                
        $this->modeladdH1();                
        
        $this->_rels ['subroles']= new User_Role_Subrole_Model();
        $this->_rels ['subroles']->setTitle('Subrole')->setName('subroles')
                ->setN1('roleid','id');        
                                   
    }    

           /**
            *  load model by primary key from db table
            *
            * @return User_Role_Model            
            **/            
            public static function loadByPK($id)
            {
                $model = new User_Role_Model();
                return $model->getGrid()->getByPk($id);
            }  
        
}
