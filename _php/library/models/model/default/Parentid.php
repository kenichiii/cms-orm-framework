<?php

class Model_Default_Parentid extends Model_Primitive_Int
{
    protected $_title = 'Rodič id';        
    
    protected $_templateName = 'parentid';    
    
    protected $_default = '0';
    
    protected $_notnull = true;
    protected $_key = true;    
    
    public function isDefault() 
    {
        return true;
    }
}

