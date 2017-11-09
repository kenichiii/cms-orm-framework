<?php

class Model_Trans extends Model_Mixed
{   
    protected $collummodel;
    protected $languages;
    
    public function __construct($collummodel,$languages=null) 
    {                      
        $this->collummodel = $collummodel;
        $this->languages = $languages==null?Project::$languages:$languages;
        
        $this->setTitle($this->getCollumModel()->getTitle());
        
        foreach ($this->getLanguages() as $key => $lang) 
        {                                         
          $this->modeladd($lang, $collummodel->setTitle($lang));
        }            
    }
    
    public function getValue($lang=null)
    {
        if($lang==null) $lang = App::getIns()->getLang();
        
        return $this->get($lang)->getValue();
    }    
    
    public function getLanguages()
    {
        return $this->languages;
    }
    
    public function getCollumModel()
    {
        return $this->collummodel;
    }    
 
    public function getCollum()
    {        
        return $this->getModelName();        
    }
}


