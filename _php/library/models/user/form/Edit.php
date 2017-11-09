<?php

class User_Form_Edit extends Model_Form
{
    protected $_name = 'userformedit';
    
    protected $_title = 'Upravit konto';
    
    protected $_modelClass = 'User_Model';                    
    
    protected $modelAction = 'edit';                
            
}

