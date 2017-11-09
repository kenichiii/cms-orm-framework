<?php

class Model_Mixed_Fullname extends Model_Mixed
{
    protected $_title = 'Jméno';
    
    public function __construct() {
        
       $titlesbefore= new Model_Primitive_Varchar();
       $this->modeladd('titlesbefore', $titlesbefore->setTitle('Tituly před'));
        
        
        $firstname = new Model_Primitive_Varchar();
        $this->modeladd('firstname', $firstname->setTitle('Křestní jméno')->setNotNull(true));
        
        $surname = new Model_Primitive_Varchar();
        $this->modeladd('surname', $surname->setTitle('Příjmení')->setNotNull(true));   
        
        $titlesafter = new Model_Primitive_Varchar();
        $this->modeladd('titlesafter',$titlesafter->setTitle('Tituly za'));

        return $this;
    }
    
    public function getWholeName()
    {
        return trim( $this->getTitlesBefore()->getValue().' '.$this->getFirstname()->getValue().' '.$this->getSurname()->getValue().' '.$this->getTitlesAfter()->getValue() );
    }
}

