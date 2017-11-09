<?php

class Page_Form_Edit extends Model_Form
{
    protected $_name = 'pageformedit';
    
    protected $_title = 'Úprava stránky';
    
    protected $_modelClass = 'Page_Model';                    
    
    protected $modelAction = 'edit';                
            
}

