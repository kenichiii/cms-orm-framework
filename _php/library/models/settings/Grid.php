<?php

class Settings_Grid extends Model_Grid
{
    protected $_title = 'Nastavení grid';
    
    protected $_table = ':db:settings';
    protected $_alias = 'st';
    
    protected $_modelClass = 'Settings_Model'; 
    
}