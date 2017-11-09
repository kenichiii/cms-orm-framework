<?php

class Model_Primitive implements Model_Interface
{
    protected $_sqlName;
    
    protected $_templateName;
    
    protected $_dibiModificater;
    
    protected $_name = null;
    protected $_rawname = null;    
    protected $_title = 'Primitive';
    
    protected $_value = null;
    
    protected $_default = null;
    
    protected $_notnull = false;
    protected $_primaryKey = false;
    protected $_key = false;
    protected $_unique = false;
    protected $_uniqueWith = null;
    protected $_innerSql = false;
   
    protected $_isChange = false;
    
    protected $_sanitize = false;
    
    
    public function isDefault() 
    {
        return false;
    }
    
    public function getDibiMod()
    {
        return $this->_dibiModificater;
    }
    
    public function isChange()
    {
        return $this->_isChange;
    }
    
    public function getRawName()
    {
        return $this->_rawname;       
    }        
    
    public function setRawName($name)
    {
        $this->_rawname = $name;
        if($this->_name==null) $this->_name = $name;
        return $this;
    }    
    
    public function setSanitize($bool)
    {
        $this->_sanitize = $bool;
        return $this;
    }
    
    public function doSanitize()
    {
        return $this->_sanitize;
    }
    
    
    public function getSqlName() {
        return $this->_sqlName;
    }
    
    public function setSqlType($type) {
        $this->_sqlName = $type;
        return $this;
    }
    
    public function getSqlType() {
        return $this->_sqlName;
    }
    
    public function setPrimaryKey($bool) {
        $this->_primaryKey = $bool;
        return $this;
    }    
    
    public function setKey($bool) {
        $this->_key = $bool;
        return $this;
    }
    
    public function isPrimaryKey() {
        return $this->_primaryKey;
    }
    
    public function isKey() {
        return $this->_key;
    }

    public function isInnerSql() {
        return $this->_innerSql;
    }
    
    public function getDefault() {
        return $this->_default;
    }
   
    public function setDefault($val) {
        $this->_default = $val;
        $this->_value = $val;
        return $this;
    }    
    
    public function setUnique($value,$with = null) {
            $this->_unique = $value;
            $this->_uniqueWith = $with;        
        return $this;    
    }
    
    public function isUnique() {
         return $this->_unique;
    }
    
    public function getUniqueWith() {
        return $this->_uniqueWith;
    }
    
    public function setNotNull($bool)
    {
        $this->_notnull = $bool;
        return $this;
    }
    
    public function isNotNull()
    {
        return $this->_notnull != null;
    }
    
    public function set($value,$from=null)
    {
        if($from=='db')
            $this->setfromdb($value);
        elseif($from=='form')
            $this->setfromform($value);
        else        
        {
            $this->_isChange = true; 
            $this->_value = $value; 
        }
                        
        return $this;
    }
    
    public function setfromdb($value)
    {
        $this->_isChange = false; 
        $this->_value = $value; 
        return $this;
    }
    
    public function setfromform($value)
    {
        $this->_isChange = true; 
        
        if($this->doSanitize())
        $this->_value = sanitize($value); 
            else     
        $this->_value = $value; 
            
        return $this;
    }
    
    public function getValue()
    {
        return $this->_value;
    }
    
    public function getCollum()
    {
        return $this->_name;
    }
    
    public function setName($name)
    {
        $this->_name = $name;
        return $this;
    }
    
    public function setTitle($title)
    {
        $this->_title = $title;
        return $this;
    }
    
    public function getTitle()
    {
        return $this->_title;
    }
        
    public function validate($formAction=null,$data=null,$model=null)
    {
        $val = new Model_Validation();

        if( $this->isNotNull() && ( $this->getValue() === null || ((is_numeric($this->getValue())&&$this->getValue()!=0)&&$this->getValue() == '') ) )
        $val->addError('notnull' , $this->getCollum (), 'Položka '. $this->getTitle().' nemůže být prázdná'  );
               
        return $val;
    }
    
    public function isModel()
    {
        return false;
    }
    
    public function isMixed()
    {
        return false;
    }    
    
    public function isPrimitive()
    {
        return true;
    }            
    
    public function getViewValue()
    {
        return $this->getValue();
    }
    
    public function templateExists( $dir, $type)
    {
        return (
          file_exists( LIBRARY_PATH .'/_dev_templates/models/' . $dir .'/'.$type.'/'.$this->getTemplateName().'.php')        
                );
    }
    
    public function getTemplate($dir,$type,$form=null,$params=array())
    {                
        if($this->templateExists($dir,$type))            
        {
            ob_start();
        
            require '_dev_templates/models/' . $dir .'/'.$type.'/'.$this->getTemplateName().'.php';
        
            $html = ob_get_clean();
        
            return $html;            
        }
        
        return null;
    }
    
    public function getTemplateName()
    {
        return $this->_templateName;
    }
    
    public function fromform($data)
    {
        foreach($data as $key=>$value)
        {  
            if( $this->getCollum() == $key )
                $this->setfromform($value);
        }
        
        return $this;
    }
}

