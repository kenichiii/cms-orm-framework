<?php


class Model_Default_Photo extends Model_Extended_Photo
{
    protected $_title = 'Hlavní foto';        
           
    public function isDefault() 
    {
        return true;
    }
}
