<?php

/*
 * ERRORS
 */
ini_set('always_populate_raw_post_data',0);
error_reporting( 0 );

/*
ini_set('display_errors',Project::$displayErrors);
error_reporting(Project::$errorReporting);

//custom error handler         
function myErrorHandler($errno, $errstr, $errfile, $errline)
{
        throw new Exception("[{$errno}] {$errstr} :: {$errfile}, {$errline}");
        // Don't execute PHP internal error handler 
    return true;
}        
set_error_handler("myErrorHandler");
*/

/*
 * PHP INI set
 */
//ini_set("max_execution_time", "60000");

ini_set('session.cache_expire', Project::$session_cache_expire);

ini_set('upload_max_filesize', Project::$upload_max_filesize);
ini_set('post_max_size', Project::$post_max_size);


/*
 * SERVER TIMEZONE
 */
date_default_timezone_set(Project::$default_timezone);




/*
 * DEFAULT FUNCTIONS
 */
foreach( new DirectoryIterator( LIBRARY_PATH . '/functions') as $file )
{
            if(  $file->getFilename() != '.' && $file->getFilename() != '..' && $file->isFile() )
            { require_once 'functions/' . $file->getFilename(); }
}


/*
 * MODELS AUTOLOAD
 */
function model_autoload($class)
{
    # we look for model


    $path = explode("_",$class);
    $lower = strtolower($path[0]);
  /*
    if( count($path) == 1 )//&& file_exists(APPLICATION_PATH . "/models/{$lower}/{$path[0]}.php")
    { require_once "models/{$lower}/{$path[0]}.php"; }
  */
    if( count($path) == 1 && ( file_exists(APPLICATION_PATH . "/models/{$path[0]}.php")
          || file_exists(LIBRARY_PATH . "/models/{$path[0]}.php") ) )
    { require_once "models/{$path[0]}.php"; }
    
    if( count($path) > 1 )
    {
         $controllerPath = $lower;
         for($i = 1;$i<count($path)-1;$i++)
         {
            $controllerPath .= strtolower("/{$path[$i]}");
         }
         
         
         if(  file_exists(APPLICATION_PATH . "/models/{$controllerPath}/".end($path).".php")
           || file_exists(LIBRARY_PATH . "/models/{$controllerPath}/".end($path).".php")     )
          { 
             require_once "models/{$controllerPath}/".end($path).".php";
          }         
    }


}

spl_autoload_register("model_autoload");

/*
 * PHPFASTCACHE
 */
require_once("phpfastcache/phpfastcache.php");

    // auto, files, sqlite, xcache, memcache, apc, memcached, wincache
    phpFastCache::setup("storage", AppCacheConfig::$CACHE_STORAGE);
    phpFastCache::setup("path", AppCacheConfig::$CACHE_DIR); // Path For Files 

/*
 * DIBI
 */
require_once 'dibi/dibi.php';


require_once 'webapp/Sess.php';        

/*
 * SESSION
 */
if( isset($_REQUEST['PHPSESSID']) )
{
//session_destroy();
session_id($_REQUEST['PHPSESSID']);

session_start();
} else {
session_start();
}
session_regenerate_id();
AppSess::start();


/*
 * WEB APPLICATION
 */

require_once 'webapp/Alert.php';        
require_once 'webapp/App.php';
require_once 'webapp/Menu.php';
require_once 'webapp/Settings.php';
require_once 'webapp/Translations.php';

require_once 'webapp/User.php';                    
require_once 'webapp/UserRoles.php';
require_once 'access.php';//application user role access function

require_once 'webapp/Mail.php';
require_once 'magick/Factory.php';


