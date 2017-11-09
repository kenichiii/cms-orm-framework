<?php

class Model_Extended_Email extends Model_Primitive_Varchar
{   
    protected $_title = 'Email';
    
    public function validate($formAction=null,$data=null,$model=null)
    {
        $val = new Model_Validation();
        
        $val->add(parent::validate($formAction,$data));
        
        if( $val->isSucc() )
        {
            if( $this->getValue()!='' && !filter_var($this->getValue(),FILTER_VALIDATE_EMAIL) ) 
            $val->addError('notvalidemail', $this->getCollum(), "Vyplněný email není validní");                 
        }
        
        return $val;
    }
}

