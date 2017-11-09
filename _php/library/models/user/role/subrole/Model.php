<?php

class User_Role_Subrole_Model extends Model_Model
{
    protected $_title = 'Uživatelské subrole';
    protected $_rawname = 'usersubroles';
    protected $_gridClass = 'User_Role_Subrole_Grid';    
    
    public function __construct()
    {        
        $this->modeladdPkId();

        $this->_model ['roleid']= new Model_Primitive_Int();
        $this->_model ['roleid']->setTitle('Role id')->setName('roleid');        
        
        $this->_model ['pointer']= new Model_Primitive_Varchar();
        $this->_model ['pointer']->setTitle('Role')->setName('pointer');        

        $this->modeladdRank();
        
        $this->modeladdH1();
        
    }    

           /**
            *  load model by primary key from db table
            *
            * @return User_Role_Subrole_Model            
            **/            
            public static function loadByPK($id)
            {
                $model = new User_Role_Subrole_Model();
                return $model->getGrid(true)->getByPk($id);
            }      
}