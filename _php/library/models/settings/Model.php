<?php

class Settings_Model extends Model_Model
{
    protected $_title = 'Settings';
    protected $_rawname = 'settings';
    
    protected $_gridClass = 'Settings_Grid';

    const TYP_STRING = "modelstring";
    const TYP_INT = "modelint";
    const TYP_BIT = "modelbit";
    const TYP_TEXT = "modeltext";
    const TYP_PRICE = "modelprice";    
    const TYP_SERIALIZED = "modelserialized";
    
    public function __construct()
    {
        $this->modeladdPkId();
        
        $this->modeladdH1();
        
        $this->_model ['pointer']= new Model_Primitive_Varchar();
        $this->_model ['pointer']->setName('pointer')->setTitle('PHP pointer')
                                ->setNotNull(true)->setKey(true);
        
        $this->_model ['section']= new Model_Primitive_Varchar();
        $this->_model ['section']->setName('section')->setTitle('Group')
                                ->setNotNull(true)->setKey(true);
                
        $this->_model ['lang']= new Model_Primitive_Varchar();
        $this->_model ['lang']->setName('lang')->setTitle('Language')
                              ->setUnique(true,array('pointer'));
        
        $this->_model ['type']= new Model_Primitive_Enum();
        $this->_model ['type']->setName('type')->setTitle('Type')
                              ->setType(self::TYP_STRING,'String')
                              ->setType(self::TYP_INT,'Number')
                              ->setType(self::TYP_BIT,'Bit')
                              ->setType(self::TYP_TEXT,'Text')
                              ->setType(self::TYP_PRICE,'Price')
                              ->setType(self::TYP_SERIALIZED,'Serialized')
                              ->setNotNull(true);
                        ;
        
        $this->_model [self::TYP_STRING]= new Model_Primitive_Varchar();
        $this->_model [self::TYP_STRING]->setName(self::TYP_STRING)->setTitle('String');

        $this->_model [self::TYP_INT]= new Model_Primitive_Int();
        $this->_model [self::TYP_INT]->setName(self::TYP_INT)->setTitle('Number');        
        
        $this->_model [self::TYP_BIT]= new Model_Primitive_Bit();
        $this->_model [self::TYP_BIT]->setName(self::TYP_BIT)->setTitle('Bit');                
        
        $this->_model [self::TYP_TEXT]= new Model_Primitive_Text();
        $this->_model [self::TYP_TEXT]->setName(self::TYP_TEXT)->setTitle('Text')
                              ->setSanitize(false);                
        
        $this->_model [self::TYP_PRICE]= new Model_Extended_Price();
        $this->_model [self::TYP_PRICE]->setName(self::TYP_PRICE)->setTitle('Price');                        
        
        $this->_model [self::TYP_SERIALIZED]= new Model_Extended_Serialized();
        $this->_model [self::TYP_SERIALIZED]->setName(self::TYP_SERIALIZED)->setTitle('Serialized');                
                
    }
    
    public function getValue()
    {
        return $this->{"get{$this->getType()->getValue()}"}()->getValue();
    }
    
    public function getDibiAlias()
    {
        if($this->getType()->getValue()==self::TYP_STRING) return 's';
        if($this->getType()->getValue()==self::TYP_INT) return 'i';
        if($this->getType()->getValue()==self::TYP_BIT) return 'i';
        if($this->getType()->getValue()==self::TYP_TEXT) return 's';
        if($this->getType()->getValue()==self::TYP_PRICE) return 'f';
        if($this->getType()->getValue()==self::TYP_SERIALIZED) return 's';        
    }
    
           /**
            *  load model by primary key from db table
            *
            * @return Settings_Model            
            **/            
            public static function loadByPK($id)
            {
                $model = new Settings_Model();
                return $model->getGrid()->getByPk($id);
            }  
}

