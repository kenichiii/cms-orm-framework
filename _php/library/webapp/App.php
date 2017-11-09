<?php

class AppException extends Exception {}
class AppDulplicateHomepageUriException extends AppException {}
class AppNonExistingPageError404Exception extends AppException {}

class App
{
    protected $languages;
           
    
    protected $folderPages = 'pages';
    
    
    protected static $ins = null;
    
    protected $isAdmin = false;
    
    protected $uri2parse;
    
    protected $currentLang;
    
    protected $pages;
    
    protected $currentPath;
    protected $currentUri;
    protected $currentPage = null;
    
    protected $pageTree = array();
    
    protected $actionFile;
    
    protected $is404;
        
    protected $addedFilesJs = array();
    protected $addedFilesCss = array();
    protected $addedFilesPhpJs = array();
    protected $addedFilesPhpCss = array();
    
    
    protected $viewName = 'template';
    
    protected static $db = null;
    
    public function getLanguages()
    {
        return $this->languages;
    }
    
    public function getParam($name)
    {
        $uri = explode('?',$this->uri2parse);
        $uri = $uri[0];
        
        $expl = explode('/',$uri);
        for($i=count($expl)-1;$i>-1;$i--)
         if( $expl[$i] == $name ) 
             if( isset($expl[$i+1]) )
                return $expl[$i+1];
             
        return null;
    }
    
    public function getPagesFolder()
    {
        return $this->folderPages;
    }
    
    public function getViewName()
    {
        return $this->viewName;
    }
    
    public function setViewName($name)
    {
        $this->viewName = $name;
    }    
    
    public static function isThumbFile($requestGet)
    {
        return (isset($requestGet[Project::$MAGICK_THUMB_GET_NAME])&&count($requestGet)==1);
    }
    
    /**
     * 
     * @param string $uri
     * @param boolean $toSingleton
     * @return type
     */
    public static function init($uri,$toSingleton=true)
    {

        $app = new App($uri);
        
        if($toSingleton) self::$ins = $app;
        
        return $app;         
    }
    
    /**
     * singleton call for App (should be inizialized)
     * 
     * @return App|null 
     */
    public static function getIns()
    {
       return self::$ins;         
    }
    
    public function isAdmin()
    {
       return $this->isAdmin; 
    }
    
    public function __construct($uri)
    {
        $this->languages = Project::$languages;
        
        $this->uri2parse = $uri;
        
        $uris = explode('?',$uri);
        $uri = $uris[0];
        
        $pies = explode('/',$uri);
        if(isset($pies[1])&&$pies[1]==Project::$ADMIN_PAGE_URI)
        {
            if(isset($pies[2])&&  in_array($pies[2], Project::$adminlanguages))
            {
                $lang = $pies[2];                                 
                $uri = preg_replace("/^\/admin\/{$lang}/", "/{$lang}/admin", $uri);
            }
            
            $this->languages = Project::$adminlanguages;
            $this->isAdmin = true;
            
        }
        
        $this->currentLang = $this->setLang($uri);
        
             
             if( $this->currentLang != $this->languages[0] )
             {                
                $uri = preg_replace("/^\/{$this->currentLang}/", "", $uri);                 
             }
             
             if( $uri == "/" || $uri == "" ) $uri = "/".Project::$HOME_PAGE_URI;
        
             if( $uri == "/".Project::$HOME_PAGE_URI."/" ) { throw new AppDulplicateHomepageUriException('/' . $this->getLangPrefix()); }

             
        $this->loadPages();     
                
        $this->findCurrentPage($uri);
        
        if( $this->currentPage() === null )            
        {
            $this->findCurrentPage( '/'  . Project::$ERROR404_PAGE_URI );
                if( $this->currentPage() === null )            
                {
                   throw new AppNonExistingPageError404Exception('non exiting page404 for '.'['.$this->getLangPrefix().']'.$uri);     
                }
            $this->is404 = true;
        } else $this->is404 = false;
        
        
    }
    
    public function is404()
    {
        $this->is404;
    }
    
    public function findCurrentPage($uri, $id_parent = 0, $level = 1 )
    {
      if( $uri != "" )
      {  
        $expl = explode('/',$uri);
        if( isset($expl[ $level ]) ) $seo_uri = $expl[ $level ];
            foreach( $this->pages as $key => $page )
            {                                
                if( $page->getUri()->getValue() == $seo_uri && $page->getParentId()->getValue() == $id_parent )
                {
                  $this->currentPath .= $page->getPointer()->getValue()."/";
                  $this->currentUri  .= $page->getUri()->getValue()."/";
                  $this->currentPage = $page;
                  $this->pageTree []= $page;
                  $this->findCurrentPage( preg_replace("/^\/{$seo_uri}/",'', $uri),$page->getId()->getValue(),$level++);
                  break;
                }
            }
        }
        
        
        return count($this->pageTree);
    }
    
    public static function getConn()
    {
        return self::$db;
    }
    
    public static function connectDatabase()
    {
        $db = new DibiConnection(Project::$databaseConfig);
        $db->getSubstitutes()->db = Project::$databasePrefix;        
        self::$db = $db;
    }
    
    
    public function tryFirstChildForEmptyPage()
    {
      if($this->currentPage()->getType()->getValue()==Page_Model::TYPE_TEXT&&$this->currentPage()->getContent()->getValue()=="")
      {
          foreach($this->getPages()as$key=>$page)
          {
              if($this->currentPage()->getId()->getValue()==$page->getParentId()->getValue() && $page->getShowinmenu()->getValue() )
              {
                  return $page;
              }
          }
      }
      return false;      
    }    
    
    /**
     * return current page path in app folder pages/
     * 
     * @return string
     */
    public function getCurrentPath()
    {
        return $this->currentPath;
    }

    public function getCurrentUri()
    {
        return $this->currentUri;
    }    
    
    public function getRootPage()
    {
        return $this->pageTree[0];
    }
    
    public function getPageTree()
    {
        return $this->pageTree;
    }
    
    public function setPageTreePage($index,$childname,$value)
    {
        $this->pageTree[$index]->set($childname,$value);
        return $this;
    }
    
    
    public static function isActionFile($uri)
    {
        return preg_match('/\.action$/', $uri);
    }

    public static function isAjaxFile($uri)
    {
        return preg_match('/\.ajax$/', $uri);
    }    
    
    public static function isPhpCssFile($uri)
    {
        return preg_match('/\.pcss$/', $uri);
    }    

    public static function isPhpJsFile($uri)
    {
        return preg_match('/\.pjs$/', $uri);
    }        
    
    public function isAction()
    {
        $uri = explode('?',$this->uri2parse);
        $uri = $uri[0];
        
        return ((self::isActionFile($uri)&&$this->actionFileExists($this->uri2parse))
               ||(self::isAjaxFile($uri)&&$this->ajaxFileExists($this->uri2parse))
               ||(self::isPhpCssFile($uri)&&$this->pcssFileExists($this->uri2parse))
               ||(self::isPhpJsFile($uri)&&$this->pjsFileExists($this->uri2parse))               
             );        
    }    
    
    public function ajaxFileExists($uri)
    {
        $uris = explode('?',$uri);
        $expl = explode("/",$uris[0]);
        $this->actionFile = $this->folderPages .'/'. $this->currentPath .'_ajax/'. preg_replace("/\.ajax/", "", end($expl)).".php";
        return file_exists( APPLICATION_PATH . '/' . $this->actionFile ) ;
    }
    
    public function actionFileExists($uri)
    {
        $uris = explode('?',$uri);
        $expl = explode("/",$uris[0]);
        $this->actionFile = $this->folderPages .'/'. $this->currentPath .'_actions/'. preg_replace("/\.action/", "", end($expl)).".php";
        return file_exists( APPLICATION_PATH . '/' . $this->actionFile ) ;
    }    

    public function pcssFileExists($uri)
    {
        $uris = explode('?',$uri);
        $expl = explode("/",$uris[0]);
        $this->actionFile = $this->folderPages .'/'. $this->currentPath .'_pcss/'. preg_replace("/\.pcss/", "", end($expl)).".php";
        if(!file_exists( APPLICATION_PATH . '/' . $this->actionFile ) )
        {
            $this->actionFile = $this->folderPages .'/'. $this->currentPath .'_pcss/require/'. preg_replace("/\.pjs/", "", end($expl)).".php";    
            return file_exists( APPLICATION_PATH . '/' . $this->actionFile );
        }
        else return true;
    }    

    public function pjsFileExists($uri)
    {
        $uris = explode('?',$uri);
        $expl = explode("/",$uris[0]);
        $this->actionFile = $this->folderPages .'/'. $this->currentPath .'_pjs/'. preg_replace("/\.pjs/", "", end($expl)).".php";
        if(!file_exists( APPLICATION_PATH . '/' . $this->actionFile ) )
        {
            $this->actionFile = $this->folderPages .'/'. $this->currentPath .'_pjs/require/'. preg_replace("/\.pjs/", "", end($expl)).".php";    
            return file_exists( APPLICATION_PATH . '/' . $this->actionFile );
        }
        else return true;
    }        
    
    public function currentPage()
    {
        return $this->currentPage;
    }
    
    public function loadPages()
    {  

      $this->pages = __c()->get("pages_{$this->currentLang}");
      
      if($this->pages==null)
      {
        $pagesGrid = new Page_Grid();
                    
        $pagesGrid->setDeletedCond()
                  ->setActiveCond()
                  ->setLangCond($this->currentLang)
                  ->setRankOrderByCond('ASC');  

        $this->pages = $pagesGrid->getData();                                
        
        __c()->set("pages_{$this->currentLang}",$this->pages,  AppCacheConfig::$APP_PAGES_LF);
      }
    }
    
    public function getPages()
    {
        return $this->pages;
    }
    
    public function getLang()
    {
        return $this->currentLang;
    }
    
    public function setLang($uri)
    {
        
         $uris = explode( '/', $uri );
        
         if(isset($uris[1]))
         $lang_index = array_search($uris[1], $this->languages);
         else $lang_index = 0;
         
         if( ! $lang_index ) {
            $lang_index = 0;
        }

        return $this->languages[ $lang_index ];
    }
    
     public function getLangPrefix()
     {
         if( $this->currentLang == $this->languages[0] ) return "";
         else return "{$this->currentLang}/";
     }
     
    public function recPagePath( $path, $id_parent )
    {
        if( $id_parent > 0 ) {
            
            foreach( $this->getPages() as $key => $page )
            {
                if( $page->getId()->getValue() == $id_parent )
                {
                    $subpath = $page->getUri()->getValue()."/".$path;
                    $path = $this->recPagePath($subpath, $page->getParentId()->getValue());
                }
            }
        }
        
       return $path;        
    }
     
     public function setLink($pointer,$params=null)
     {           
            if( $pointer == '_curr' ) $pointer = $this->currentPage()->getPointer()->getValue();
         
            $currentPage = null;
            foreach( $this->getPages() as $key => $page )
            {
                if( $page->getPointer()->getValue() == $pointer )
                {
                    $currentPage = $page;
                    break;
                }
            }         
            
            if( $currentPage != null ) 
            {
                
                if( $currentPage->getPointer()->getValue() == Project::$HOME_PAGE_POINTER )
                $currentPath = "";
                else
                $currentPath = $this->recPagePath($currentPage->getUri()->getValue() . "/", $currentPage->getParentId()->getValue());
            }
              
            
            if($this->isAdmin())
            $uri = Project::$WEB_URL ."/". Project::$ADMIN_PAGE_URI .'/'. $this->getLangPrefix() .preg_replace ('/^(admin\/)/', '', $currentPath);            
            else                
            $uri = Project::$WEB_URL ."/". $this->getLangPrefix() .(isset($currentPath)?$currentPath:$pointer.'-undefined');            
            
            if(is_array($params))
            foreach($params as $key=>$value)
                $uri .= $key.'/'.urlencode ($value).'/';
            elseif(is_numeric($params) || is_string($params))
                $uri .= urlencode ($params).'/';
            
            return $uri;
     }
              
     public function setActionFile($action,$pointer,$file=null,$params=null)
     {
            if( $pointer == '_curr' ) $pointer = $this->currentPage()->getPointer()->getValue();
            if( $file == null ) $file = $pointer;

            $currentPage = null;
            foreach( $this->getPages() as $key => $page )
            {
                if( $page->getPointer()->getValue() == $pointer )
                {
                    $currentPage = $page;
                    break;
                }
            }
            
            $currentPath = "";
            if( $currentPage != null )
            $currentPath = $this->recPagePath($currentPage->getUri()->getValue(). "/". $file .".{$action}", $currentPage->getParentId()->getValue());

            if($this->isAdmin())
            $uri = Project::$WEB_URL ."/". Project::$ADMIN_PAGE_URI .'/'. $this->getLangPrefix() .preg_replace ('/^(admin\/)/', '', $currentPath);            
            else    
            $uri = Project::$WEB_URL ."/". $this->getLangPrefix() .$currentPath;            
            
            if(is_array($params))
            {
               $uri .= '?';  
               $i = 0;
               foreach($params as $key=>$value)
               {
                   $uri .= $key.'='.urlencode ($value);
                   if( $i < count($params)-1 ) $uri .= '&amp;';
                   $i++;
               }
            }
            
            return $uri;
     }
     
     public function setAjaxLink($pointer,$file,$params=null)
     {
         return $this->setActionFile('ajax', $pointer, $file, $params);
     }
     
     public function setActionLink($pointer,$file,$params=null)
     {
         return $this->setActionFile('action', $pointer, $file, $params);
     }
   
     public function setPcssLink($pointer,$file,$params=null)
     {
         return $this->setActionFile('pcss', $pointer, $file, $params);
     }

     public function setPjsLink($pointer,$file,$params=null)
     {
         return $this->setActionFile('pjs', $pointer, $file, $params);
     }     
     
     public function getActionFile()
     {
         return $this->actionFile;
     }
     
     /**
      * 
      * @param Array $get
      * @param Array $post
      * @return string html|json|plain action file ouput
      */
     public function runAction($get=array(),$post=array(),$sess=array())
     {
         $_GET_BACKUP_VAR = $_GET;
         $_POST_BACKUP_VAR = $_POST;
         $_SESSION_BACKUP_VAR = $_SESSION;
         $_GET = $get;
         $_POST = $post;
         $_SESSION = $sess;
         
         ob_start();         
         require $this->actionFile;
         $output = ob_get_contents();
         ob_end_clean();
         
         $_GET = $_GET_BACKUP_VAR;
         $_POST = $_POST_BACKUP_VAR;
         $_SESSION = $_SESSION_BACKUP_VAR;
         
         return $output;
     }
     
     public function runLayout($get=array(),$post=array(),$sess=array())
     {
         $_GET_BACKUP_VAR = $_GET;
         $_POST_BACKUP_VAR = $_POST;
         $_SESSION_BACKUP_VAR = $_SESSION;
         $_GET = $get;
         $_POST = $post;
         $_SESSION = $sess;
         
       ob_start();    
         if(file_exists(APPLICATION_PATH . '/layouts/'.$this->currentPage()->getLayout()->getValue().'/controller.php'))
         { require 'layouts/'.$this->currentPage()->getLayout()->getValue().'/controller.php'; }
         
         if(file_exists(APPLICATION_PATH .'/'. $this->getPagesFolder() .'/'. $this->getCurrentPath() .'controller.php'))
         { require $this->getPagesFolder() .'/'. $this->getCurrentPath() .'controller.php'; }
                  
         require 'lay1outs/'.$this->currentPage()->getLayout()->getValue().'/layout.php';
         $output = ob_get_contents();
         ob_end_clean();
         
         $_GET = $_GET_BACKUP_VAR;
         $_POST = $_POST_BACKUP_VAR;
         $_SESSION = $_SESSION_BACKUP_VAR;
         
         return $output;
         
     }
     
     public function addFileJs($file)
     {
         $this->addedFilesJs []= $file;
     }
     
     public function addFileCss($file)
     {
         $this->addedFilesCss []= $file;
     }

     public function addFilePhpJs($file)
     {
         $this->addedFilesPhpJs []= $file;
     }
     
     public function addFilePhpCss($file)
     {
         $this->addedFilesPhpCss []= $file;
     }     
          
     public function getAddedFilesJs()
     {
         return $this->addedFilesJs;
     }
     
     public function getAddedFilesCss()
     {
         return $this->addedFilesCss;
     }     

     public function getAddedFilesPhpJs()
     {
         return $this->addedFilesPhpJs;
     }
     
     public function getAddedFilesPhpCss()
     {
         return $this->addedFilesPhpCss;
     }        
     
     public function getAssetsFilesCss()
     {        
         $files = array();
         
         $dir = 'assets/pages/'.$this->getCurrentPath().'css';         
         if( is_dir(PUBLIC_PATH.'/'.$dir) )
         {             
             foreach( new DirectoryIterator($dir) as $file )
             {
                $expl = explode('.',$file->getFilename());
                if(end($expl)=='css')
                    $files []= '/'.$dir.'/'.$file->getFilename();
             }             
         }
         
         return $files;
     }

     public function getPhpFilesCss()
     {        
         $files = array();
         
         $dir = 'pages/'.$this->getCurrentPath().'_pcss';         
         if( is_dir(APPLICATION_PATH.'/'.$dir) )
         {             
             foreach( new DirectoryIterator(APPLICATION_PATH.'/'.$dir) as $file )
             {
                $expl = explode('.',$file->getFilename());
                if(end($expl)=='php')
                {
                    $name = str_replace('.php','',$file->getFilename());
                    $files []= $this->setPcssLink($this->currentPage()->getPointer()->getValue(), $name);
                }
             }             
         }
        
         return $files;
     }     
     
     public function getAssetsFilesJs()
     {         
         $files = array();
         
         $dir = 'assets/pages/'.$this->getCurrentPath().'js';
         if( is_dir(PUBLIC_PATH.'/'.$dir) )
         {             
             foreach( new DirectoryIterator($dir) as $file )
             {
                $expl = explode('.',$file->getFilename());
                if(end($expl)=='js')
                    $files []= '/'.$dir.'/'.$file->getFilename();
             }
         }
                  
         return $files;
     }     

     public function getPhpFilesJs()
     {         
         $files = array();
         
         $dir = 'pages/'.$this->getCurrentPath().'_pjs';
         if( is_dir(APPLICATION_PATH .'/'.$dir) )
         {             
             foreach( new DirectoryIterator(APPLICATION_PATH.'/'.$dir) as $file )
             {
                $expl = explode('.',$file->getFilename());
                if(end($expl)=='php')
                {
                    $name = str_replace('.php','',$file->getFilename());
                    $files []= $this->setPjsLink($this->currentPage()->getPointer()->getValue(), $name);                    
                }
             }
         }
                  
         return $files;
     }        
     
     public function getLangTemplateSrc()
     {
         return $this->getPagesFolder().'/'. $this->getCurrentPath() . $this->getViewName()."_".$this->getLang().".php";
     }
     
     public function getTemplateSrc()
     {
         return $this->getPagesFolder().'/'.$this->getCurrentPath() . $this->getViewName().".php";
     }
     
     public static function getCurrentCacheKey()
     {
         return "pagecache-".md5($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].$_SERVER['QUERY_STRING']);
     }

     public static function getCurrentSuperCacheKey()
     {
         return "pagesupercache-".md5($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].$_SERVER['QUERY_STRING']);
     }     
    
     /**
      * return full path to layout template from current page
      * 
      * @param string $file 
      * @return string path
      */

     public function getLayoutTemplate($file)
    {            
        return 'layouts/'.$this->currentPage()->getLayout()->getValue().'/templates/'.$file.'.php';        
    }
    
    
    public function getLangISO()
    {
        if($this->getLang()=='cz') return 'cs';
        return $this->getLang();
    }        
    
    
    
    
    
    
    
    
}

