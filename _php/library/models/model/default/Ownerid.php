<?php

class Model_Default_Ownerid extends Model_Primitive_Int
{
    protected $_title = 'Patří id';                
        
    protected $_notnull = true;
    protected $_key = true;    
    
    public function isDefault() 
    {
        return true;
    }
}


