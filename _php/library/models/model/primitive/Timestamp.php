<?php

class Model_Primitive_Timestamp extends Model_Primitive_Datetime 
{
    public function getValue($fresh=false) {
        if($fresh||$this->_value == null)
            $this->_value = date('Y-m-d G:i:s');
        
        return $this->_value;
    }
}