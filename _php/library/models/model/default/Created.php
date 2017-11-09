<?php

class Model_Default_Created extends Model_Primitive_Timestamp
{
    protected $_title = 'Datum vytvoření';

    protected $_templateName = 'created';

    
    public function isDefault() 
    {
        return true;
    }
}
