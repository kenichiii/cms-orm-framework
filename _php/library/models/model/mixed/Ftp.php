<?php


class Model_Mixed_Ftp extends Model_Mixed
{
    protected $_title = 'FTP účet';
    
    public function __construct() {
        
        $this->_model ['server']= new Model_Primitive_Varchar();
        $this->_model ['server']->setTitle('Server')->setRawName('server')
                                  ->setNotNull(true);
        
        $this->_model ['port']= new Model_Primitive_Int();
        $this->_model ['port']->setTitle('Port')->setRawName('port')
                                  ->setNotNull(true)->setDefault(80);
        
        
        $this->_model ['user']= new Model_Primitive_Varchar();
        $this->_model ['user']->setTitle('Login')->setRawName('user')
                                  ->setNotNull(true);
                
        $this->_model ['pwd']= new Model_Primitive_Varchar();
        $this->_model ['pwd']->setTitle('Heslo')->setRawName('pwd')
                                  ->setNotNull(true);   
        
        return $this;
    }    
}

