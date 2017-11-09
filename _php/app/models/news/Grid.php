<?php

class News_Grid extends Model_Grid
{
    
    protected $_title = 'Novinky';
    
    protected $_modelClass = 'News_Model';
    
    protected $_table = ':db:news';
    protected $_alias = 'nw';
    
                   
}
