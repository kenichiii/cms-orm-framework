<?php

class User_Roles_Model extends Model_Model
{
    protected $_title = 'Uživatelé2roles';
    protected $_rawname = 'user2roles';
    protected $_gridClass = 'User_Roles_Grid';
    
    public function __construct()
    {        
        $this->modeladdPkId();

        $this->_model ['userid']= new Model_Primitive_Int();
        $this->_model ['userid']->setTitle('User id')->setName('userid')
                ->setKey(true);                                
        
        $this->_model ['roleid']= new Model_Primitive_Int();
        $this->_model ['roleid']->setTitle('Role id')->setName('roleid')
                ->setKey(true);        
        
        $this->_model ['role']= new User_Role_Model();
        $this->_model ['role']->setTitle('Role')->setName('role')
                ->setJoin('id','roleid');        
                
        $this->_model ['subroleid']= new Model_Primitive_Int();
        $this->_model ['subroleid']->setTitle('Subrole id')->setName('subroleid')
                ->setKey(true);        

        $this->_model ['subrole']= new User_Role_Subrole_Model();
        $this->_model ['subrole']->setTitle('Subrole')->setName('subrole')
                ->setJoin('id','subroleid');        
                
    }    
    
           /**
            *  load model by primary key from db table
            *
            * @return User_Roles_Model            
            **/            
            public static function loadByPK($id)
            {
                $model = new User_Roles_Model();
                return $model->getGrid()->getByPk($id);
            }  
    
}