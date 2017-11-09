<?php

class Model_Default_Date extends Model_Primitive_Date
{
    protected $_title = 'Datum';
    protected $sorting = 'DESC';
    
    protected $_notnull = true;
    
    public function isDefault() 
    {
        return true;
    }
    
    public function setSorting($new) 
    {
        $this->sorting = $new;
        return $this;
    }
    
    public function getSorting() 
    {
        return $this->sorting;
    }
}

