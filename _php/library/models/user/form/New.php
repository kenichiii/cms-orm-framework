<?php

class User_Form_New extends Model_Form
{
    protected $_name = 'userformnew';
    
    protected $_title = 'Nové konto';
    
    protected $_modelClass = 'User_Model';                    
    
    protected $modelAction = 'new';                
            
}

