<?php

class Model_Default_Active extends Model_Primitive_Bit
{
    protected $_title = 'Aktivní';
    
    protected $_default = '0';
    protected $_value = 0;
    
    protected $_key = true;
    protected $_notNull=true;
    
    protected $_templateName = 'active';
    
    public function isDefault() 
    {
        return true;
    }
}
