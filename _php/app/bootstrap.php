<?php

//GET CONFIGS
    //application, db, errors, system emails, php ini, allowed thumbs, htaccess generators 
    require_once 'config/Project.php';      

    //cache lifetimes
    require_once 'config/Cache.php';      
    
    
//BOOT enviroment  
    //php settings + functions + errorHandler + autoloading + phpfastcache folder + dibi + lib/web/*
    require_once 'bootstrap/master.php'; 

    //__c()->clean();
    
//GO APP        
try {          

    //basic auth for dev
    if( Project::$image == IMAGE_DEV )
    { require 'bootstrap/dev_auth.php'; }
   
    //test cache for current request
    $html = __c()->get(App::getCurrentSuperCacheKey());
    if($html!=null)
    {
                                //clean uri
                        $uris = explode('?',$_SERVER['REQUEST_URI']);
                        //if is php css
                        if(App::isPhpCssFile($uris[0]))
                        {
                            define('APP_USE_SUPERCACHE_FOR_HTML_PAGE',false);
                            //print header
                            header("Content-Type: text/css"); 
                            header("X-Content-Type-Options: nosniff"); //for IE
                        }
                        elseif(App::isPhpJsFile($uris[0]))
                        {
                            define('APP_USE_SUPERCACHE_FOR_HTML_PAGE',false);
                            header('Content-Type: application/javascript');
                        }
                        elseif(App::isActionFile($uris[0])||App::isAjaxFile($uris[0]))
                        {
                            define('APP_USE_SUPERCACHE_FOR_HTML_PAGE',false);    
                        }
                        else {
                            define('APP_USE_SUPERCACHE_FOR_HTML_PAGE',true);    
                            //we wait for end of html document
                            //print /body /html tags
                        }
                        
        echo $html;  
        //we dont exit because we can require non-cached file at the end
    } 
    
    
    ###DEVINSTALL###
    elseif(preg_match('/(\/'.Project::$DEV_INSTALL_URI.'\/)$/', $_SERVER['REQUEST_URI']) )
    {
        //run protected project config form
        require 'bootstrap/install_auth.php';
        require_once 'pages/admin/dev/install.php';
        exit;
    }
    ###ENDDEVINSTALL###        
                                    
    //if isset GET cacheimg we have request for non-existing image 
    elseif( App::isThumbFile($_GET) )
    {        
        //generate image base on request params, save it to docs/_cache/img/docs
        //and output        
        header("Content-Type: image/jpg");
        echo Magick_Factory::createThumb($_GET[Project::$MAGICK_THUMB_GET_NAME]);
        exit;
    }
    
    else {
    
    //connect db
    App::connectDatabase();
            
    //get current request without Project::$WEB_URL
    $ssl = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? true:false;
    $sp = strtolower($_SERVER['SERVER_PROTOCOL']);
    $protocol = substr($sp, 0, strpos($sp, '/')) . (($ssl) ? 's' : '');    
    $request = str_replace(Project::$WEB_URL,'',$protocol.'://'. $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);//we dont care about rewriting get part        
            
    //init app for current request
    try {
        try {
            
            App::init($request);
            
            } catch (AppDulplicateHomepageUriException $homelink)
                {
                    header("HTTP/1.1 301 Moved Permanently"); //we have lang here in message
                    header("Location: ".Project::$WEB_URL.$homelink->getMessage());
                    exit();        
                }
    } catch (AppNonExistingPageError404Exception $e)
    {
        throw new Exception($e);
    }

    
    
    //check basic page access or redirect with flash alert
    if(!access())
    {
        AppAlert::set('Pro přístup na požadovanou stránku nemáte patřičná oprávnění');
        if(App::getIns()->isAdmin()) reloadPage (App::getIns()->setLink(Project::$ADMIN_PAGE_POINTER));
        else reloadPage (App::getIns()->setLink(Project::$HOME_PAGE_POINTER));
        exit;
    }

    
    
    
    //lets improve include path by current _php/app/pages/<currentPagePath>
    set_include_path(implode(PATH_SEPARATOR, array(
        get_include_path(), 
    APPLICATION_PATH . '/'.App::getIns()->getPagesFolder().'/' . App::getIns()->getCurrentPath()
    )));    
                       

    //lets run app - starts with action file              
             //if
               //ajax,action,phpcss,phpjs 
               //- should be cached by case in their code
       if( App::getIns()->isAction() )
                    {         
                        //clean uri
                        $uris = explode('?',$request);
                        //if is php css
                        if(App::isPhpCssFile($uris[0]))
                        {
                            //print header
                            header("Content-Type: text/css"); 
                            header("X-Content-Type-Options: nosniff"); //for IE
                        }
                        elseif(App::isPhpJsFile($uris[0]))
                        {
                            header('Content-Type: application/javascript');
                        }
                        
                        //get no scope cleen action file ready for more requires 
                        require App::getIns()->getActionFile();    
                        
                        
          } //endif App->isAction                    
      else 
       //show HTML page
         {                       

            //exception for not found
            if( App::getIns()->is404() ) {                
                header("HTTP/1.1 404 Not Found");
            }
            //or if page is type text and content is empty try to 301 redirect to first menu child
            elseif($childpage = App::getIns()->tryFirstChildForEmptyPage())
            {            
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".App::getIns()->setLink($childpage->getPointer()->getValue()));
                exit();
            }
            

            //lets get html for page
                $html = __c()->get(App::getCurrentCacheKey());
           
                            if($html==null)
                            {           
                              define('APP_USE_CACHE_FOR_HTML_PAGE',false);
                              
                              //if not page cached lets generate html 
                                ob_start();
                                       //get no scope controller of current layout
                                         if(file_exists(APPLICATION_PATH . '/layouts/'.App::getIns()->currentPage()->getLayout()->getValue().'/controller.php'))
                                            { require 'layouts/'.App::getIns()->currentPage()->getLayout()->getValue().'/controller.php'; }

                                       //get no scope controller of current page                                            
                                            if(file_exists(APPLICATION_PATH .'/'. App::getIns()->getPagesFolder() .'/'. App::getIns()->getCurrentPath() .'controller.php'))
                                            { require App::getIns()->getPagesFolder() .'/'. App::getIns()->getCurrentPath() .'controller.php'; }
     
                                       //run layout                                                 
                                            require 'layouts/'.App::getIns()->currentPage()->getLayout()->getValue().'/layout.php';

                                                                                                
                                // GET HTML WEBPAGE
                                $html = ob_get_clean();
                              
                 
                                //if page use cache and dont use user roles system, save as supercache
                                if(App::getIns()->currentPage()->getCache()->getValue()>0&&App::getIns()->currentPage()->getAccess()->getValue()=="")
                                {                                   
                                    // Save to Cache 
                                    __c()->set(App::getCurrentSuperCacheKey(),$html, App::getIns()->currentPage()->getCacheLifeTime()->getValue());
                                }
                                elseif(App::getIns()->currentPage()->getCache()->getValue()>0)
                                {
                                    // save access() protected page html
                                    __c()->set(App::getCurrentCacheKey(),$html, App::getIns()->currentPage()->getCacheLifeTime()->getValue());
                                }
                            
                          }
                          else {
                             define('APP_USE_CACHE_FOR_HTML_PAGE',true);
                          }  
                            
                            //OUTPUT LAYOUTED TEXT/HTML
                            echo $html;                                                                                                                                                                                                                                                                                                
                                                                                                       
            } //end else for if App->isAction     
            
            
    } //end else aplication logic if(supercache) elseif(dev-install) elseif(thumb) else        
    
    if( //we used layout to generate html
            defined('APP_USE_SUPERCACHE_FOR_HTML_PAGE')&&APP_USE_SUPERCACHE_FOR_HTML_PAGE
         || defined('APP_USE_CACHE_FOR_HTML_PAGE')    
           
      )
    {
                    //test for flash alert, print </body></html>
                    require_once 'html.endpage.php';                                        
                    
                    //lets look at page generation time at the end
                    if(Project::$image!=IMAGE_PROD)                    
                      echo  devprintservertime();
                    
                    
    }
    
//total app crash            
} catch(Exception $e)
{
         if(preg_match('/^(SQLSTATE\[HY000\])/',$e->getMessage()))
         {
           //make space  
           __c()->clean();  
           //lets repeat whole rendering
           require 'bootstrap.php';
         }
         else {
    //report to Project::$crashEmail
    $html = errorException($e);
    
    //show error warning screen
    require_once 'layouts/error/layout.php';
         }
}


