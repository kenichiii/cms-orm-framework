<?php

class Model_InnerSql extends Model_Primitive
{    
    protected $_innerSql = true;   
    
    public function isPrimitive()
    {
        return false;
    }

    public function isInnerSql()
    {
        return true;
    }
    
}
