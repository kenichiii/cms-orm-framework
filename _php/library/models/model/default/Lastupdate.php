<?php

class Model_Default_Lastupdate extends Model_Primitive_Datetime
{
    protected $_title = 'Poslední aktualizace';

    protected $_templateName = 'lastupdate';

    
    public function isDefault() 
    {
        return true;
    }
}


