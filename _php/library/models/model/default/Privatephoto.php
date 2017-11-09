<?php


class Model_Default_Privatephoto extends Model_Extended_PrivateFoto
{
    protected $_title = 'Hlavní foto';        
           
    public function isDefault() 
    {
        return true;
    }
}

