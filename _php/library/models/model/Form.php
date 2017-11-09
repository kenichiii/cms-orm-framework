<?php

class Model_Form
{
    protected $_title = 'Model Form';
    protected $_method = 'post';
    protected $_action;
    protected $_name = 'modelform';
    
    protected $_modelClass;
    
    protected $modelAction;
    
    
    const ACTION_NEW = 'new';
    const ACTION_EDIT = 'edit';
    
    public function getModelAction()
    {
        return $this->modelAction;
    }
    
    public function getModelClass()
    {
        return $this->_modelClass;
    }
    
    public function templateExists($action,$type)
    {
        return file_exists(LIBRARY_PATH.'/_dev_templates/models/form/'.$action.'/'.$type.'/template.php');
    }
    
    public function getTemplate($action,$type,$collum=null)
    {
      $html = null;
      
      if(file_exists(LIBRARY_PATH.'/_dev_templates/models/form/'.$action.'/'.$type.'/template.php'))  
      {
        ob_start();
        
        require '_dev_templates/models/form/'.$action.'/'.$type.'/template.php';
        
        $html = ob_get_clean();
      }
      
      return $html;
    }
    
    public function getModel()
    {
        return new $this->_modelClass();
    }
    
    public function setModel($class)
    {
        $this->_modelClass = $class;
        return $this;
    }    
    
    public function getTitle()
    {
        return $this->_title;
    }
    
    public function getMethod()
    {
        return $this->_method;
    }

    public function getName()
    {
        return $this->_name;
    }    
    
    public function getAction()
    {
        return $this->_action;
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
    
    public function setMethod($method)
    {
        $this->_method = $method;
        return $this;
    }
    
    public function setAction($action)
    {
        $this->_action = $action;
        return $this;
    }
    
}
