<?php

class Model_Extended_SafeRichText extends Model_Extended_RichText
{
    
    protected $_templateName = 'simplerichtext';
    protected $_allowedTags = array('sup','sub','u','em','br','hr','p','ul','li','ol','b','strong');
               
    
    public function getAllowedTags()
    {
        return $this->_allowedTags;
    }
    
    public function setAllowedTags($allow)
    {
        $this->_allowedTags = $allow;
        return $this;
    }
    
    public function setfromform($value) {

        
        foreach ($this->getAllowedTags() as $key=>$tag)
        {
            $value = str_replace('<'.$tag.'>', '[:['.$tag.']:]', $value);
            $value = str_replace('</'.$tag.'>', '[:[/'.$tag.']:]', $value);            
            $value = str_replace('<'.$tag.' />', '[:['.$tag.' /]:]', $value);
            $value = str_replace('<'.$tag.'/>', '[:['.$tag.'/]:]', $value);
        }
        
        $value = sanitize($value);
        
        foreach ($this->getAllowedTags() as $key=>$tag)
        {
            $value = str_replace('[:['.$tag.']:]', '<'.$tag.'>', $value);
            $value = str_replace('[:[/'.$tag.']:]', '</'.$tag.'>', $value);            
            $value = str_replace('[:['.$tag.' /]:]', '<'.$tag.' />', $value);
            $value = str_replace('[:['.$tag.'/]:]', '<'.$tag.'/>', $value);            
        }        
        
        $this->_value = $value; 
            
        return $this;
    }
}
