<?php

class User_Model extends Model_Model
{
    protected $_title = 'Uživatel';
    protected $_rawname = 'user';
    protected $_gridClass = 'User_Grid';
    
    protected $_roles = null;
    
    public function __construct()
    {        
        $this->modeladdPkId();

        $this->_rels ['roles']= new User_Roles_Model();
        $this->_rels ['roles']->setName('roles')->setTitle('Role')
                ->setN1('userid','id');

        $this->_model ['subjectid']= new Model_Primitive_Int();
        $this->_model ['subjectid']->setTitle('Subjekt id')->setName('subjectid')
                               ->setKey(true)->setNotNull(true);                        
        
        $this->_model ['login']= new Model_Primitive_Varchar();
        $this->_model ['login']->setTitle('Login')->setName('login')
                               ->setUnique(true)->setNotNull(true);        
        
        $this->_model ['fullname']= new Model_Mixed_Fullname();
        $this->_model ['fullname']->setName('fullname');                
        
        $this->_model ['email']= new Model_Extended_Email();
        $this->_model ['email']->setName('email')->setUnique(true)->setNotNull(true);
                
        $this->_model ['pwd']= new Model_Extended_Password();
        $this->_model ['pwd']->setTitle('Heslo')->setName('pwd');

        $this->_model ['subject']= new User_Subject_Model();
        $this->_model ['subject']->setTitle('Subjekt')->setName('subject')
                                 ->setJoin('id','subjectid');                
        
        $this->modeladdDeleted();     
        
        $this->modeladdCreated();
        
        $this->_model ['lastlogin']= new Model_Primitive_Datetime();
        $this->_model ['lastlogin']->setName('lastlogin')->setTitle('Datum posledního přihlášení');
    }    
    
    public function hasRole($role)
    {
        $has = false;
        foreach($this->loadRoles() as $key=>$r)
            if($r->getRole()->getPointer()->getValue()==$role) { $has = true; break; } 

        return $has;     
    }
    
    public function getSubRole($role)
    {
        $s = null;
        foreach($this->loadRoles() as $key=>$r)
            if($r->getRole()->getPointer()->getValue()==$role) return $r->getSubRole();
                    
    }    
    
    public function loadRoles()
    {
       if($this->_roles==null) 
        $this->_roles = $this->getRoles()->getData();
       
       return $this->_roles;
    }
    
           /**
            *  load model by primary key from db table
            *
            * @return User_Model            
            **/            
            public static function loadByPK($id)
            {
                $model = new User_Model();
                return $model->getGrid()->getByPk($id);
            }  
}
