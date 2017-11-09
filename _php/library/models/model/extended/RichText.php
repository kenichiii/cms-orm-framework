<?php

class Model_Extended_RichText extends Model_Primitive_Text 
{
    protected $_templateName = 'richtext';
    protected $_sanitize = false;

        public function getValue()
    {
        return str_replace('../../','/',$this->_value);
    }
    
        public function getViewValue()
    {
        return str_replace('../../','/',$this->_value);
    }
    
}