<?php

class Model_Validation
{
    protected $errors = array();
    
    public function addError($type,$element,$message) {
        $this->errors[]= array( 'el' => $element,'mess'=>$message,'type'=>$type);
        return $this;
    }
    
    public function add(Model_Validation $v)
    {
       $this->errors = array_merge($this->errors,$v->getErrors());
       return $this;
    }
    
    public function getErrors()
    {
        return $this->errors;
        
    }
    
    public function isSucc()
    {
        return count($this->getErrors()) > 0 ? false : true;
    }
}

