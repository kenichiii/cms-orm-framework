<?php

class Translations_Grid extends Model_Grid
{    
    protected $_title = 'Translations';
    
    protected $_modelClass = 'Translations_Model';
    
    protected $_table = ':db:translations';
    protected $_alias = 'trs';
    
    protected $isAdmin = false;
    
    public function __construct($admin=false) {
        if((App::getIns()&&App::getIns()->isAdmin())||$admin)
        {
            $this->_table = 'translationsadmin';
            $this->isAdmin = true;
        }
    }
    
    public function isAdmin()
    {
        return $this->isAdmin;
    }
    
    public function getModel($fresh=false)
    {
        if($this->model===null||$fresh) $this->model = new $this->_modelClass($this->isAdmin()?true:false);
        
        return $this->model;
    }
    
}

