<?php

class Model_Extended_PhoneNumber extends Model_Primitive_Varchar
{
    protected $_title = 'Telefon';
    
    public function validate($formAction=null,$data=null,$model=null)
    {
        $val = new Model_Validation();
        
        $val->add(parent::validate($formAction,$data));
        
        if( $val->isSucc() )
        {
            if( $this->getValue()!='' && (strlen(str_replace(' ', '', trim($this->getValue())))!=9 || !is_numeric(str_replace(' ', '', trim($this->getValue()))) )) 
            $val->addError('notvalidphone', $this->getCollum(), "Zadejte telefon jako 9 číslic");                 
        }
        
        return $val;
    }   
}

