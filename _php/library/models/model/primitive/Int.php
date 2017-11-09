<?php


class Model_Primitive_Int extends Model_Primitive
{
    protected $_templateName = 'int';
    protected $_sqlName = 'INT';
    protected $_max = 11;
    protected $_dibiModificater = '%i';
    
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

