<?php

class User_Role_Subrole_Grid extends Model_Grid
{
    protected $_title = 'Uživatelské subrole';
    
    protected $_table = ':db:userssubroles';
    protected $_alias = 'usrsurl';
    
    protected $_modelClass = 'User_Role_Subrole_Model';
}