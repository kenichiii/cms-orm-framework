<?php

class Model_Extended_File extends Model_Primitive_Varchar
{
    protected $_title = 'Soubor';

    protected $_templateName = 'file';   
    
    protected $_dir = null;
    
    protected $allowedExt = array('jpg','png','gif','pdf','doc','docx','xls','txt','zip','csv','avi','mp3','mp4');    
    
    public function isImage()
    {
        return in_array($this->getExt(),Project::$images);
    }

    public function isVideo()
    {
        return in_array($this->getExt(),Project::$videos);
    }    

    public function getExt()
    {
        $h = explode('.',$this->getValue());
        $e = end($h);
        return strtolower($e);
    }
    
    public function isValidFile($filename)
    {
        $h = explode('.',$filename);
        $ext = end($h);
        return in_array(strtolower($ext), $this->getAllowedExt());
    }
    
    public function getAllowedExt() {
        return $this->allowedExt;
    }
    
    public function setAllowedExt($array) {
        $this->allowedExt = $array;
        return $this;
    }    
    
    public function setDir($dir) {
        $this->_dir = $dir; 
        return $this;
    }
    
    public function getDir() {
        return $this->_dir; 
    }
    
    public function getFullPath() {
        return $this->getDir() . '/' . $this->getValue();
    }
}

