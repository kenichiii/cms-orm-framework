<?php

class Model_Extended_Price extends Model_Primitive_Decimal
{
    protected $_title = 'Cena';    
    protected $_max = '10,2';
    
    public function getViewValue()
    {
        return $this->getValue().' Kč';
    } 
    
    public function cenaDPH($dph)
    {
          $koef = 1+intval($dph)/100;
          
          $sumDPH = $this->getValue()*$koef;
          $val = ceil($sumDPH);   
          
          return "{$val} Kč";
    }
}
