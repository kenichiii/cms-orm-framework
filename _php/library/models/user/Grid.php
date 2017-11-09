<?php

class User_Grid extends Model_Grid
{
    protected $_title = 'Uživatelé';
    
    protected $_table = ':db:users';
    protected $_alias = 'usr';
    
    protected $_modelClass = 'User_Model';
    
}
