<?php

class Page_Model extends Model_Model {
    
    protected $_title = 'WWW stránka';   
    protected $_rawname = 'page';
    
    protected $_gridClass = 'Page_Grid';
    
    const TYPE_SYSTEM = 'system';
    const TYPE_TEXT = 'text';
    
    public function __construct() {                
        
        $this->modeladdPkId();    
           //die('test');
        $this->modeladdParentId();
            
        $pointer = new Model_Primitive_Varchar();
        $pointer->setTitle('Pointer')->setNotNull(true);
        $this->modeladd('pointer', $pointer);
                
        $uri = new Model_Default_Uri();
        $uri->setUnique(false);
        $this->modeladd('uri',$uri);
                
        $layout = new Model_Primitive_Varchar();
        $layout->setTitle('Layout')
                             ->setNotNull(true)->setDefault('default')
                             ->setSanitize(false);
        $this->modeladd('layout',$layout);
        
        
        $menuname = new Model_Primitive_Varchar();
        $menuname->setTitle('Název v menu')
                             ->setNotNull(true)->setSanitize(false);
        $this->modeladd('menuname',$menuname);                
        
        $this->modeladdH1()->get('h1')->setSanitize(false);
        

        $description = new Model_Primitive_Text();
        $description->setTitle('SEO popis')->setSanitize(false);
        $this->modeladd('description',$description);
        
        
        $this->modeladdContent();
        
        $access = new Page_Access();
        $access->setTitle('Access')->setSanitize(false);
        $this->modeladd('access', $access);
        
        $this->modeladdRank()->getRank()->setSorting('ASC');
        
        $this->modeladdActive();        
                
        $showinmenu = new Model_Primitive_Bit();
        $showinmenu->setTitle('V menu')->setDefault('0');
        $this->modeladd('showinmenu',$showinmenu);

        $footermenu = new Model_Primitive_Bit();
        $footermenu->setTitle('V menu v patičce')->setDefault('0');        
        $this->modeladd('footermenu', $footermenu);
        
        $cache = new Model_Primitive_Bit();
        $cache->setTitle('Cache on')->setDefault('1');
        $this->modeladd('cache', $cache);
                
        $cachelifetime = new Model_Primitive_Int();
        $cachelifetime->setNotNull(true)->setTitle('Cache time')             
                ->setDefault(AppCacheConfig::$MODEL_PAGE_DEFAULT_LF);
        $this->modeladd('cachelifetime',$cachelifetime);
        
        $type = new Model_Primitive_Enum();
        $type->setTitle('Typ')
                ->setType(self::TYPE_TEXT,'Textová stránka')
                ->setType(self::TYPE_SYSTEM,'Systémová stránka')
                ->setNotNull(true);
        $this->modeladd('type',$type);
        
        $lang = new Model_Default_Lang();
        $lang->setUnique(true,array('pointer'));
        $this->modeladd('lang',$lang);
        
        $this->modeladdDeleted();
        
        $this->modeladdCreated();
        
        $this->modeladdLastupdate();
        
        $gallery = new Page_Gallery_Model();
        $gallery->setN1('ownerid','id');
        $this->relationsadd('gallery', $gallery);
        
        $this->modeladdPhoto();
    }
    
    
    
    
            /**
            *  load model by primary key from db table
            *
            * @return Page_Model            
            **/            
            public static function loadByPK($id)
            {
                $model = new Page_Model();
                return $model->getGrid()->getByPk($id);
            }   
            
            public static function loadById($id)
            {
                $model = new Page_Model();
                return $model->getGrid()->where(' and '.$model->getGrid()->getAlias('id').'=%i',$id)->getSingle();
            }
            
            public function getChildren()
            {
                $coll = $this->isParentAble();
                return $this->getGrid()->where(' and '.$this->getGrid()->getAlias($coll->getCollum()).'=%i',$this->getPrimaryKey()->getValue());
            }

            
            /**
            *  return parent model instance with id=this.parentid
            *
            * @return \Page_Model
            
            **/                         
            public function getParent()
            {
                if($this->getParentid()->getValue()==0) return null;
                return $this->getGrid()->where(' and '.$this->getGrid()->getAlias($this->getPrimaryKey()->getCollum()).'=%i',$this->getParentid()->getValue())->getSingle();
            }   

            
            public function setRank()
            {
              $coll = $this->isRankAble();  
              $parent = $this->isParentIdAble();
              
              $this->set($coll->getCollum(),(Page_Grid::getConn()->fetchSingle("select max({$coll->getCollum()}) from ".$this->getGrid()->getTableRaw()." 
                where {$parent->getCollum()}=%i", $parent->getValue() )+1));                
                return $this;
            }  
            
}

