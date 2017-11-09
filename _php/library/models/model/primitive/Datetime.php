<?php

class Model_Primitive_Datetime extends Model_Primitive
{
    protected $_templateName = 'datetime';
    protected $_sqlName = 'DATETIME';
    protected $_dibiModificater = '%t';
    
    public function fromform($data)
    {
        foreach($data as $key=>$value)
        {            
            if( $this->getCollum().'_date' == $key )            
               $form_date = $value;     
            
            if( $this->getCollum().'_hours' == $key )            
               $form_hours = $value;     

            if( $this->getCollum().'_min' == $key )            
               $form_min = $value;     
            
            if( $this->getCollum().'_sec' == $key )            
               $form_sec = $value;     
        }
        
        if( isset($form_date) && $form_date!==null && $form_date!='' )
            $this->_value = Date('Y-m-d G:i:s',strtotime ($form_date.' '.$form_hours.':'.$form_min.':'.$form_sec));
        
        return $this;
    }    
    
    public function getViewValue()
    {
        if(!$this->getValue()) return '---';        
        return $this->getInDate();
    }
    
    public function getInDate($f='j.n.Y G:i:s')
    {
        if(!$this->getValue()) return null;
        return Date( $f, $this->getInTime($this->getValue()));
    }
    
    public function getInTime()
    {
        if(!$this->getValue()) return null;
        return strtotime($this->getValue());
    }     
}
