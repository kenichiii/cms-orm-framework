<?php

class Model_Default_Rank extends Model_Primitive_Int
{
    protected $_title = 'Pořadí';   
    
    protected $_templateName = 'rank';        
    
    protected $_notnull = true;
    protected $_key = true;        
    
    protected $sorting = 'DESC';
    
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

