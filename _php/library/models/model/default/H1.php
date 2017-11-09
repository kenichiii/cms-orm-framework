<?php

class Model_Default_H1 extends Model_Primitive_Varchar
{
    protected $_title = 'Nadpis';        
    protected $_notnull = true;
    
    public function isDefault() 
    {
        return true;
    }
}
