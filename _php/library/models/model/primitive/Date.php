<?php

class Model_Primitive_Date extends Model_Primitive
{
    protected $_templateName = 'date';
    protected $_sqlName = 'DATE';
    protected $_dibiModificater = '%d';
    
    public function setfromform($value)
    {
        if($value)
        {
            $this->_value = Date('Y-m-d',  strtotime($value));             
            $this->_isChange = true; 
        }

        return $this;
    }
    
    public function getViewValue()
    {
        if(!$this->getValue()) return '---';
        return $this->getToDate();
    }    
    
    public function getToDate($f='j.n.Y')
    {
        if(!$this->getValue()) return null;
        return Date( $f, $this->getToTime($this->getValue()));
    }
    
    public function getToTime()
    {
        if(!$this->getValue()) return null;
        return strtotime($this->getValue());
    }    
}

