<?php


class Model_Primitive_Text extends Model_Primitive
{
    protected $_sqlName = 'TEXT';
    protected $_templateName = 'text';
    protected $_sanitize = true;
    protected $_dibiModificater = '%s';
    
    public function getPerex($maxlength=50)
    {
        return perex($this->getValue(),$maxlength);
    }
}