<?php

class User_Subject_Grid extends Model_Grid
{
    protected $_title = 'Subjekty';
    
    protected $_table = ':db:usersubjects';
    protected $_alias = 'sb';
    
    protected $_modelClass = 'User_Subject_Model';
}

