<?php

class Model_Primitive_Bit extends Model_Primitive
{
    protected $_templateName = 'bit';
    protected $_sqlName = 'TINYINT';
    protected $_max = 1;    
    protected $_dibiModificater = '%i';
    
    
    protected $_onStatusTitle,$_onActionTitle,$_offStatusTitle,$_offActionTitle;
    
    public function getViewValue()
    {
        return $this->getValueTitle();
    }
    
    public function isOn() {
        return $this->getValue() == 1;
    }
    
    public function setOn( $status, $action ) {
        $this->_onStatusTitle = $status;
        $this->_onActionTitle = $action;
        
        return $this;
    }
    
    public function setOff( $status, $action ) {
        $this->_offStatusTitle = $status;
        $this->_offActionTitle = $action;
        
        return $this;
    }    
    
    public function getValueTitle() {
        return $this->getValue() == 1 ? $this->_onStatusTitle : $this->_offStatusTitle;
    }
    
    public function getValueActionTitle() {
        return $this->getValue() == 1 ? $this->_offActionTitle : $this->_onActionTitle;
    }    
}

