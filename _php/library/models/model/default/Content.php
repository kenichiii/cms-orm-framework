<?php

class Model_Default_Content extends Model_Extended_RichText
{
    protected $_title = 'Obsah';
    
    public function isDefault() 
    {
        return true;
    }    
}

