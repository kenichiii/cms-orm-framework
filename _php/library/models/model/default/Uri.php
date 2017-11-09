<?php

class Model_Default_Uri extends Model_Primitive_Varchar
{
    protected $_title = 'Uri';
    protected $_templateName = 'uri';        
    
    protected $_notnull = true;
      
    protected $_unique = true;         
    
    public function isDefault() 
    {
        return true;
    }
}

