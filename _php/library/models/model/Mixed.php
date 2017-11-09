<?php

class Model_Mixed implements Model_Interface
{
    protected $_title = 'Mixed';
    
    protected $_model = array();
    
    protected $_name = null;
    protected $_rawname = null;
 
    public function getRawName() {
        return $this->_rawname;
    }

    public function setRawName($name) {
        $this->_rawname = $name;
        if($this->_name==null)$this->_name=$name;
    }
    
    /**
     * 
     * @param string $name [a-z]
     * @param string $model
     * @return \Model_Mixed
     */
    public function modeladd($name,$model)
    {
        $this->_model [$name]= $model;
        $this->_model [$name]->setRawName($name);
                            
        return $this;
    }  
    
    public function getModel()
    {
        return $this->_model;
    }
    
    public function clearModel($name=null)
    {
        if($name==null) $this->_model = array();
        elseif(isset($this->_model[$name])) unset($this->_model[$name]);
        else throw new Exception("{$this->getTitle()} has not have {$name} to clear");
    }
    
    public function addChild($name,$class)
    {
        $this->_model [$name]=$class;
        return $this;
    }
    
    public function setModel($model)
    {
        $this->_model = $model; 
        return $this;
    }
    
    public function setName($name)
    {
        $this->_name = $name;        
        if($this->isMixed()) {
            $this->buildMixed ($name.'_');
        }
        
        return $this;
    }
    
    public function buildMixed($prefix='')
    {
        foreach ($this->getModel() as $key => $child) {
            if($child->isMixed())
            {
                $child->buildMixed($prefix.$child->getModelName().'_');
            }
            elseif($child->isPrimitive())
            {                
                $child->setName($prefix.$child->getRawName());
            }
        }
 
    }
    
    
    public function setTitle($title)
    {
        $this->_title = $title; 
        return $this;        
    }
    
    
    public function set( $child, $value, $from = null)
    {
            $test = explode('_',$child);
        
            $rek = array();
            for($i=1; $i < count($test); $i++)
            {
                $rek []= $test[$i];
            }
            
            if(isset($this->_model[$test[0]]) && count($rek) && ! $this->_model[$test[0]]->isPrimitive() )
                $this->_model[$test[0]]->set(implode('_',$rek),$value,$from);
            
            elseif(isset($this->_model[$test[0]]) && !count($rek) )     
                $this->_model[$test[0]]->set($value,$from);
            
            else throw new Exception ("{$this->getTitle ()} cant set {$child}");
            
            return $this;
    }
    
    
    
    public function get($child)
    {
            $test = explode('_',$child);
        
            $rek = array();
            for($i=1; $i < count($test); $i++)
            {
                $rek []= $test[$i];
            }
            

            
            if(isset($this->_model[$test[0]]) && count($rek) )
                return $this->_model[$test[0]]->get(implode('_',$rek));
            
            elseif(isset($this->_model[$test[0]]) && !count($rek) )     
                return $this->_model[$test[0]]; 
            
            else throw new Exception ("{$this->getModelTitle ()} cant get {$child}");        
    }
    
    public function __call($name, $arguments) {
        $child = preg_replace('/^(get)/', '', strtolower($name));
        
        if(isset($this->_model[$child]))        
                return $this->_model[$child];
        else return null;        
    }
    
    public function validate($formAction=null,$data=null,$model=null)
    {
        $val = new Model_Validation();
        foreach ($this->getModel() as $key => $value) {
            if($value->isPrimitive())
                $val->add($this->get($value->getCollum())->validate($formAction,$data,$model));
            elseif($value->isMixed())
            {
              foreach ($value->getModel() as $mkey => $mvalue) {  
                              if($mvalue->isPrimitive())
                                    $val->add($this->get($mvalue->getCollum())->validate($formAction,$data,$model));
                                elseif($mvalue->isMixed())
                                {
                                  $val->add($this->validateMixed($mvalue,$formAction,$data,$model));
                                }
              }
            }
        }
        
        return $val;
    }        

    public function validateMixed($mixed,$formAction,$data,$model)
    {
        $val = new Model_Validation();
        foreach ($mixed->getModel() as $key => $value) {
            if($value->isPrimitive())
                $val->add($this->get($value->getCollum())->validate($formAction,$data,$model));
            elseif($value->isMixed())
            {
              foreach ($value->getModel() as $mkey => $mvalue) {  
                              if($mvalue->isPrimitive())
                                    $val->add($this->get($mvalue->getCollum())->validate($formAction,$data,$model));
                                elseif($mvalue->isMixed())
                                {
                                  $val->add($this->validateMixed($mvalue,$formAction,$data,$model));
                                }
              }
            }
        }
        
        return $val;
    }        
    
    
    public function getModelName()
    {
        return $this->_name;
    }
    
    public function getModelTitle()
    {
        return $this->_title;
    }
    
    public function isModel()
    {
        return false;
    }
    
    public function isDefault() 
    {
        return false;
    }
    
    public function isMixed()
    {
        return true;
    }    
    
    public function isPrimitive()
    {
        return false;
    }

    public function isInnerSql()
    {
        return false;
    }    
    
    public function getCollumsRaw()
    {
        $collums = array();
        
        foreach($this->getModel() as $key=>$child)
        {
            if($child->isInnerSql()||($child->isPrimitive()&&$child->isPrimaryKey()))
                continue;            
                        
            elseif($child->isPrimitive()) 
            {                
                $collums []= $child;
            }
            elseif($child->isMixed())
            {
                $collums = array_merge($collums,$child->getCollumsRaw());
            }
        }
        
        return $collums;
    }
    
    public function getCollumsInArray()
    {
        $collums = array();
        
        foreach($this->getModel() as $key=>$child)
        {
            if($child->isInnerSql()||($child->isPrimitive()&&$child->isPrimaryKey()))
                continue;            
                        
            elseif($child->isPrimitive()) 
            {                
                $collums [$child->getCollum()]= $child->getValue();
            }
            elseif($child->isMixed())
            {                
                $collums = array_merge($collums,$child->getCollumsInArray());
            }
        }
        
        return $collums;
    }
    
    public function getCollumsForUpdate()
    {
        $collums = array();
        
        foreach($this->getModel() as $key=>$child)
        {
            if($child->isInnerSql()||($child->isPrimitive()&&$child->isPrimaryKey()))
                continue;            
                        
            elseif($child->isPrimitive() && $child->isChange()) 
            {                
                $collums [$child->getCollum()]= $child->getValue();
            }
            elseif($child->isMixed())
            {                
                $collums = array_merge($collums,$child->getCollumsForUpdate());
            }
        }
        
        return $collums;
    }
    
    
    public function fromform($data)
    {  
        foreach ($this->getCollumsRaw() as $key => $child) 
        {
            
                $this->get($child->getCollum())->fromform($data);                                
           
        }
        
        return $this;
    }
}
