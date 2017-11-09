<?php

class Model_Primitive_Enum extends Model_Primitive_Varchar
{
    protected $_templateName = 'enum';
    protected $_types = array();
    
    protected $_notNull = true;


    public function getViewValue()
    {
        return $this->getType($this->getValue());
    }
    
    public function setType($key,$title)
    {
        $this->_types[$key]=$title;
        
        return $this;
    }
    
    public function getTypes()
    {
        return $this->_types;
    }
    
    public function getTypesRaw()
    {
        return array_keys($this->_types);
    }
    
    public function getType($key)
    {
        return $this->_types[$key];
    }
    
    public function validate($formAction=null,$data=null,$model=null)
    {
        $val = new Model_Validation();
        
        $val->add(parent::validate());
        
        if( $val->isSucc() )
        {
            if( !in_array($this->getValue(),$this->getTypesRaw()) )
            {
               $val->addError('notenumtype' , $this->getCollum (), 'Položka '.$this->getTitle().' není validní typ'  );
            }
        }
        
        return $val;
    }    
}

