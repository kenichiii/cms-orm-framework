<?php

function _et($srctext,$section=null,$params=array(),$lang=null,$srclang=null) {
    echo _t($srctext, $section,  $lang, $params,$srclang);
}

function _t($srctext,$section=null,$params=array(),$lang=null,$srclang=null) {
    if($section==null) $section = "page-".App::getIns ()->currentPage ()->getPointer()->getValue();
    if($lang==null) $lang = App::getIns ()->getLang ();
    if($srclang==null) $srclang = Project::$DEV_TRANS_LANG;
    return AppTranslations::get($srctext, $section, $params,$lang, $srclang);
}

class AppTranslations
{
    protected static $dict;
    
    public static function get($srctext,$section,$params,$lang,$srclang)
    {
            $founded = null;
            if(isset(self::$dict[$section]))
            {
                foreach (self::$dict[$section] as $key=>$row)
                {
                    if($row->get('src')->getValue()==$srctext)
                    {
                        return self::$dict[$section][$key][$lang]!='' 
                               ? self::applyParams(self::$dict[$section][$key][$lang],$params)
                               : 'N/T['.self::$dict[$section][$key]['id'].']'.self::applyParams($srctext,$params);
                    }
                }
            }
            
                $cdata = __c()->get('app-translations-'.$section);
                if($cdata==null)
                {
                    $tgrid = new Translations_Grid();
                    $cdata = $tgrid->where( ' and '.$tgrid->getAlias('section').'=%s',$section)->getData();                   
                     __c()->set('app-translations-'.$section,$cdata,  AppCacheConfig::$TRANSLATIONS_LF);
                }
                
                    foreach ($cdata as $key=>$row)
                    {
                      //foreach(Project::$languages as $l)  
                      self::$dict[$section][$key][$lang]=$row->get($lang)->getValue();
                      self::$dict[$section][$key]['src']=$row->get('src')->getValue();    
                      self::$dict[$section][$key]['id']=$row->get('id')->getValue();    
                      
                        if($row->get('src')->getValue()==$srctext)
                        {
                            $textkey = $key;                            
                         }
                     }
                    
                     if(isset($textkey))
                     return self::$dict[$section][$textkey][$lang]!=''
                             ? self::applyParams(self::$dict[$section][$textkey][$lang],$params)
                             : 'N/T['.self::$dict[$section][$textkey]['id'].']'.self::applyParams($srctext,$params);
                  
                 
                 
                //not existing db record row                                        
                        $id = self::addText($srclang,$srctext,$section);
                        __c()->clean();
                        
                        if($srclang==$lang) return self::applyParams($srctext,$params);
                        
                        return 'N/T['.$id.']'.self::applyParams($srctext,$params);                                    
   }
           
   public static function applyParams($text,$params)
   {
       return $text;
   }
   
   /**
    * 
    * @param type $srclang
    * @param type $text
    * @param type $section
    * @return type
    */
   public static function addText($srclang,$text,$section)
   {
       //model insert
       $g = new Translations_Grid();
       if(in_array($srclang, App::getIns()->getLanguages()))
            return $g->getModel()->set('section',$section)->set($srclang,$text)->set('src',$text)
               ->insert();
       else
            return $g->getModel()->set('section',$section)->set('src',$text)
               ->insert();
           
       
       
   }
}

