<?php

class Model_Default_Perex extends Model_Primitive_Text
{
    protected $_title = 'Perex'; 
    
    protected $_notnull = true;
    
    public function isDefault() 
    {
        return true;
    }    
}
