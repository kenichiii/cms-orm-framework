<?php

interface Model_Interface {

    public function setName($name);

    public function setTitle($title);    
    
    public function getRawName();
    public function setRawName($name);
    
    public function isPrimitive();    

    public function isMixed();
    
    public function isModel();
    
    public function isInnerSql();
    public function isDefault();
        
    //Mixed set( $child, $value, $from = null)
    //Primitive set( $value, $from = null )
        
    public function fromform($data);
    
    //return Model_Validation
    public function validate($formAction=null,$data=null,$model=null);
    
    
}
