<?php

class Model_Extended_Photo extends Model_Extended_File
{
    protected $_title = 'Foto';

    protected $_templateName = 'photo';   
    
    protected $allowedExt = array('jpg','png','gif');
}