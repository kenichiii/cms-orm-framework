<?php

class Model_Default_Id extends Model_Primitive_Int
{
    protected $_title = 'Id';        
    
    protected $_primaryKey = true;    
    
    public function isDefault() 
    {
        return true;
    }
}

