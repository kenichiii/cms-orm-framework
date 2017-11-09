<?php

class Translations_Model extends Model_Model
{
    protected $_rawname = 'translations';
    protected $_title = 'Translations';
    
    protected $_gridClass = 'Translations_Grid';
    
    public function __construct($admin=false) {
        
        $this->modeladdPkId();
        
        $section = new Model_Primitive_Varchar();
        $section->setTitle('Section')->setKey(true);            
        $this->modeladd('section', $section);
                
        $src = new Model_Primitive_Text();
        $src->setTitle('Source');
        $this->modeladd('src', $src);
        
                               //->setKey(true);          
        $langs = $this->getGrid()->isAdmin()||$admin ? Project::$adminlanguages : Project::$languages;
        foreach($langs as $lang)
        {
            $langcollum = new Model_Primitive_Text();
            $langcollum->setTitle($lang)->setSanitize(false);
            $this->modeladd($lang, $langcollum);
        }
    }
    
           /**
            *  load model by primary key from db table
            *
            * @return Translations_Model            
            **/            
            public static function loadByPK($id)
            {
                $model = new Translations_Model();
                return $model->getGrid()->getByPk($id);
            }  
    
}


