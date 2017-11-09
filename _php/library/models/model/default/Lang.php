<?php

class Model_Default_Lang extends Model_Primitive_Enum
{
    protected $_title = 'Jazyk';        
    
    protected $_key = true;
    
    protected $_notnull = true;
    
    public function __construct() {
        foreach (Project::$languages as $value) {
          $this->setType($value, $value);   
        }
    }


    public function isDefault() 
    {
        return true;
    }
}
