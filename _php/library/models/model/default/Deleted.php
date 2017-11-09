<?php

class Model_Default_Deleted extends Model_Primitive_Bit
{
    protected $_title = 'Smazaný';
    
    protected $_default = '0';
    protected $_value = 0;
    
    protected $_templateName = 'deleted';
    
    
    protected $_key = true;
    protected $_notnull=true;
    
    public function isDefault() 
    {
        return true;
    }
}
