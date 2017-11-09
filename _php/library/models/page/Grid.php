<?php

class Page_Grid extends Model_Grid 
{   
    protected $_title = 'WWW stránky';
    
    protected $_table = ':db:pages';
    protected $_alias = 'pg';
    
    protected $_modelClass = 'Page_Model';      
    
    public function getMaxRank($parentid)
    {
        return Page_Grid::getConn()->fetchSingle('select max(rank) from '.$this->getTableRaw().' where parentid=%i',$parentid);
    }
}