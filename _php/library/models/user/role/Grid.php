<?php

class User_Role_Grid extends Model_Grid
{
    protected $_title = 'Uživatelské role';
    
    protected $_table = ':db:usersroles';
    protected $_alias = 'usrrl';
    
    protected $_modelClass = 'User_Role_Model';
}