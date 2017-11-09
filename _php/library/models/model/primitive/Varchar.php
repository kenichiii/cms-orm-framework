<?php

class Model_Primitive_Varchar extends Model_Primitive
{
    protected $_sqlName = 'VARCHAR';
    protected $_max = 255;
    protected $_templateName = 'varchar';
    protected $_sanitize = true;
    protected $_dibiModificater = '%s';
    
    public function getSqlType() {
        return $this->_sqlName.'('.$this->getMax().')';
    }
    
    public function setMax($value)
    {
        $this->_max = $value;
        
        return $this;
    }

    public function getMax()
    {
        return $this->_max;
    }
    
    
    public function validate($formAction=null,$data=null,$model=null)
    {
        $val = new Model_Validation();
        
        $val->add(parent::validate());
        
        if( $val->isSucc() )
        {
            if( $this->isNotNull() && $this->getValue() == '' )
            {
               $val->addError('notnull' , $this->getCollum (), 'Položka '.$this->getTitle().' nemůže být prázdná'  );
            }
            elseif(mb_strlen($this->getValue()) > $this->getMax() )
            {
                $val->addError('maxlength' , $this->getCollum (), $this->getTitle().' nemůže být delší než '.$this->getMax().' znaků');
            }
        }
        
        return $val;
    }
         
}

