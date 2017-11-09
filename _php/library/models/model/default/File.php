<?php


class Model_Default_File extends Model_Extended_File
{
    protected $_title = 'Hlavní soubor';        
           
    public function isDefault() 
    {
        return true;
    }
}