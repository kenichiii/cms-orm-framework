<?php

class User_Roles_Grid extends Model_Grid
{
    protected $_title = 'Uživatelé 2 role';
    
    protected $_table = ':db:users2roles';
    protected $_alias = 'u2r';
    
    protected $_modelClass = 'User_Roles_Model';
}
