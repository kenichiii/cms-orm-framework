<?php

class Model_Mixed_Database extends Model_Mixed
{
    protected $_title = 'Databázový účet';
    
    public function __construct() {
        
        $this->_model ['hostname']= new Model_Primitive_Varchar();
        $this->_model ['hostname']->setTitle('Hostname')->setRawName('hostname')
                                  ->setDefault('localhost');
        
        $this->_model ['port']= new Model_Primitive_Int();
        $this->_model ['port']->setTitle('Port')->setRawName('port')
                                  ->setDefault(21);        
        $this->_model ['user']= new Model_Primitive_Varchar();
        $this->_model ['user']->setTitle('Uživatel')->setRawName('user');
                                      
        $this->_model ['pwd']= new Model_Primitive_Varchar();
        $this->_model ['pwd']->setTitle('Heslo')->setRawName('pwd');
                                      
        $this->_model ['database']= new Model_Primitive_Varchar();
        $this->_model ['database']->setTitle('Databáze')->setRawName('database');
        
    }
}


