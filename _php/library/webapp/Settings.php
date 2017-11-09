<?php

class AppSettings
{
    protected static $sections = array();
    protected static $pointers = array();

    public static function getBySection($section,$lang=null)
    {
      if($lang===null) $lang = App::getIns ()->getLang();  
      
      
      if(isset(self::$sections[$section][$lang]))  
      {
          return self::$sections[$section][$lang];
      }                
      
      if($cdata = __c()->get(md5('appsettings-section-'.$section.'-'.$lang)))
      {
          self::$sections[$section][$lang] = $cdata;
          return self::$sections[$section][$lang];
      }
      
        
        
        $grid = new Settings_Grid();
        
        $grid->where(' and (%or) ',array(array('lang=%s',$lang),array('lang=%s','uni')))
             ->where(' and '.$grid->getAlias().'.section=%s',$section);    
        
        $bean = new stdClass();
        foreach( $grid->getData() as $key=>$model )
            $bean->{$model->getPointer()->getValue()} = $model->getValue();
        
        self::$sections[$section][$lang] = $bean;    
        __c()->set(md5('appsettings-section-'.$section.'-'.$lang),$bean,  AppCacheConfig::$SETTINGS_LF);    
            
        return $bean;    
    }

    public static function getByPointer($pointer,$lang=null)
    {
      if($lang===null) $lang = App::getIns ()->getLang();  
        
      if(isset(self::$pointers[$pointer][$lang]))  
      {
          return self::$pointers[$pointer][$lang];
      }          
      
      if($cdata = __c()->get(md5('appsettings-pointer-'.$pointer.'-'.$lang)))
      {
          self::$pointers[$pointer][$lang] = $cdata;
          return self::$pointers[$pointer][$lang];
      }
      

        
        $grid = new Settings_Grid();
        
        $grid->where(' and (%or) ',array(array('lang=%s',$lang),array('lang=%s','uni')))
             ->where(' and '.$grid->getAlias().'.pointer=%s',$pointer);    
        
        
            $bean = self::$pointers[$pointer][$lang] = $grid->getSingle();    
            __c()->set(md5('appsettings-pointer-'.$pointer.'-'.$lang),$bean,AppCacheConfig::$SETTINGS_LF);  
                
        return self::$pointers[$pointer][$lang];            
    }
    
    public static function updateByPointer($pointer,$newvalue,$lang=null)
    {
        if($lang===null) $lang = App::getIns ()->getLang();
        
        $model = self::getByPointer($pointer, $lang);
        
            $model->set($model->getType()->getValue(),$newvalue);

            $model->update();
        
        /*
        return dibi::query('UPDATE '.$model->getGrid()->getTableRaw().' SET '
                    . $model->getType()->getValue() .'=%'.$model->getDibiAlias()
                    . ' WHERE pointer=%s and lang=%s',
                $newvalue, $pointer, $lang
                );
         * 
         */
    }
}




