<?php

class Model_Primitive_Decimal extends Model_Primitive
{
    protected $_templateName = 'decimal';
    protected $_sqlName = 'DECIMAL';
    protected $_max = '10,2';
    protected $_dibiModificater='%f';
    
    public function getSqlType() {
        return $this->_sqlName.'('.$this->getMax().')';
    }  
    
    public function setMax($value)
    {
        $this->_max = $value;
        
        return $this;
    }

    public function getMax()
    {
        return $this->_max;
    }  
}

