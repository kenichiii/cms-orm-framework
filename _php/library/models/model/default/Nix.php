<?php

class Model_Default_Nix extends Model_Mixed
{
    protected $_title = 'Vnořené indexy';
    
    public function __construct() {
        $this->_model ['lft']= new Model_Primitive_Int();
        $this->_model ['lft']->setRawName('lft')->setTitle('Levý index')
                                  ->setNotNull(true)->setKey(true)
                ->setTemplateName('lft');
        
        $this->_model ['rtg']= new Model_Primitive_Int();
        $this->_model ['rtg']->setRawName('rtg')->setTitle('Pravý index')
                                  ->setNotNull(true)->setKey(true)
                ->setTemplateName('rtg');    
    
    }

}

