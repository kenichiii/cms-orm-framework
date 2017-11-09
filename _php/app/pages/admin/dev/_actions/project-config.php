<?php


    foreach ($_POST as $key=>$value)
    {                
        if(is_array($key)) 
        {            
            ${$key} = $key;
        }
        else    
        ${$key} = $value;
    }
 
$image = isset($image) ? $image : Project::$image;
$title = isset($title) ? $title : Project::$title;
$name  = isset($name) ? $name : Project::$name;
$weburl= isset($weburl) ? $weburl : Project::$WEB_URL;
$langs = isset($langs) ? $langs : implode(',',  Project::$languages);
$adminlangs = isset($adminlangs) ? $adminlangs : implode(',',  Project::$adminlanguages);
$devlang = isset($devlang) ? $devlang : Project::$DEV_TRANS_LANG;

$db_hostname = isset($db_hostname) ? $db_hostname : Project::$databaseConfig['host'];
$db_username = isset($db_username) ? $db_username : Project::$databaseConfig['username']; 
$db_password = isset($db_password) ? $db_password : Project::$databaseConfig['password']; 
$db_database = isset($db_database) ? $db_database : Project::$databaseConfig['database'];
$db_prefix = isset($db_prefix) ? $db_prefix : Project::$databasePrefix;

$crashemail = isset($crashemail) ? $crashemail : Project::$crashmail;
$infoemail = isset($infoemail)?$infoemail:Project::$infomail;

$installauthpwd = isset($installauthpwd) ? $installauthpwd : Project::$installAuthPwd;    
$basicauthpwd = isset($basicauthpwd) ? $basicauthpwd : Project::$basicAuthPwd;    

$projectconfigRozmery = implode('","',  Project::$allowedThumbs);
$povolenerozmery = isset($povolenerozmery) ? $povolenerozmery : '"'.$projectconfigRozmery.'"';    

$allowedfiles = isset($allowedfiles) ? $allowedfiles : Project::$allowedFiles;
$htaccess_force_www = isset($htaccess_force_www) ? $htaccess_force_www : (Project::$htaccess_force_www?'yes':'no');

$displayerrors = isset($displayerrors) ? $displayerrors : Project::$displayErrors;
$errorreportimg = isset($errorreportimg) ? $errorreportimg : (Project::$errorReporting == 32767 ? 'E_ALL' : Project::$errorReporting);
$upload_max_filesize = isset($upload_max_filesize) ? $upload_max_filesize : Project::$upload_max_filesize;
$post_max_size = isset($post_max_size) ? $post_max_size : Project::$post_max_size;
$default_timezone = isset($default_timezone) ? $default_timezone : Project::$default_timezone;
$session_cache_expire = isset($session_cache_expire) ? $session_cache_expire : Project::$session_cache_expire;         

//TEST database
try {
    App::connectDatabase(array('host'=>$db_hostname,'username'=>$db_username,'password'=>$db_password,'database'=>$db_database));
    
    try {
     if($db_prefix!=Project::$databasePrefix)
     {
         $tables = App::getConn()->fetchAll("SHOW TABLES");
       if(count($tables))
       {    
         foreach($tables as $tr=>$tablerow)
         {
            $old = $tablerow->{"Tables_in_{$db_database}"};
            $new = preg_replace('/^('.str_replace('_','\_', Project::$databasePrefix).')/', $db_prefix, $old);
            App::getConn()->query("RENAME TABLE [{$old}] TO [{$new}]");            
         }
         echo "\nDATABASE tables has been RENAMED"; 
       }
     }
    } catch (Exception $ex) {
        echo "\nERROR - ".$ex->getMessage();
    }
    
} catch (Exception $ex) {
    echo "\nERROR - database connection test FAIL \n\n";
}



//WRITE HTACCESS
if($allowedfiles!=Project::$allowedFiles||(($htaccess_force_www=='yes'&&Project::$htaccess_force_www==false)||($htaccess_force_www=='no'&&Project::$htaccess_force_www==true)))
{
    $ssl = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? true:false;
    $sp = strtolower($_SERVER['SERVER_PROTOCOL']);
    $protocol = substr($sp, 0, strpos($sp, '/')) . (($ssl) ? 's' : '');    
    $webfolder = str_replace($protocol.'://'. $_SERVER['HTTP_HOST'],'',$weburl);    
    
        ob_start();
            require_once '_dev_templates/config/htaccess.php';
        $code = ob_get_contents();
        ob_end_clean();

        if(file_put_contents(PUBLIC_PATH.'/.htaccess', $code))
            echo ".htaccess file has been written \n";
        else echo "\n ERROR - writing .htaccess file \n\n";    
} //end htaccess


//TEST PHP INI
ini_set('upload_max_filesize', $upload_max_filesize);
$upload_max_filesize_test = ini_get('upload_max_filesize');
if($upload_max_filesize_test!=$upload_max_filesize) echo "\n ERROR PHP INI upload_max_filesize is set to {$upload_max_filesize_test} \n\n";

ini_set('post_max_size', $post_max_size);
$post_max_size_test = ini_get('post_max_size');
if($post_max_size_test!=$post_max_size) echo "\n ERROR PHP INI upload_max_filesize is set to {$post_max_size_test} \n\n";

date_default_timezone_set(Project::$default_timezone);
$default_timezone_test = date_default_timezone_get();
/*
if (strcmp($default_timezone_test, ini_get('date.timezone'))){
    echo "\n ERROR PHP INI Script timezone differs from ini-set timezone:".ini_get('date.timezone')." \n\n";
} else
*/
if($default_timezone_test!=$default_timezone) {
    echo "\n ERROR PHP INI date_default_timezone is set to {$default_timezone_test} \n\n";
}

ini_set('session.cache_expire', intval($session_cache_expire));
$session_cache_expire_test = ini_get('session.cache_expire');
if($session_cache_expire_test!=intval($session_cache_expire)) echo "\n ERROR PHP INI session.cache_expire is set to {$session_cache_expire_test} \n\n";

ini_set('display_errors',$displayerrors);
$displayerrors_test = ini_get('display_errors');
if($displayerrors_test!=intval($displayerrors)) echo "\n ERROR PHP INI display_errors is set to {$displayerrors_test} \n\n";

/*
error_reporting($errorreportimg=='E_ALL'?E_ALL:intval($errorreportimg));
$errorreportimg_test = error_reporting();
if($errorreportimg_test!=($errorreportimg=='E_ALL'?E_ALL:intval($errorreportimg)) echo "\n ERROR PHP INI error_reporting is set to {$errorreportimg_test} \n\n";
*/
/*
function error_level_tostring($intval, $separator)
{
    $errorlevels = array(
        E_ALL => 'E_ALL',
        E_USER_DEPRECATED => 'E_USER_DEPRECATED',
        E_DEPRECATED => 'E_DEPRECATED',
        E_RECOVERABLE_ERROR => 'E_RECOVERABLE_ERROR',
        E_STRICT => 'E_STRICT',
        E_USER_NOTICE => 'E_USER_NOTICE',
        E_USER_WARNING => 'E_USER_WARNING',
        E_USER_ERROR => 'E_USER_ERROR',
        E_COMPILE_WARNING => 'E_COMPILE_WARNING',
        E_COMPILE_ERROR => 'E_COMPILE_ERROR',
        E_CORE_WARNING => 'E_CORE_WARNING',
        E_CORE_ERROR => 'E_CORE_ERROR',
        E_NOTICE => 'E_NOTICE',
        E_PARSE => 'E_PARSE',
        E_WARNING => 'E_WARNING',
        E_ERROR => 'E_ERROR');
    $result = '';
    foreach($errorlevels as $number => $name)
    {
        if (($intval & $number) == $number) {
            $result .= ($result != '' ? $separator : '').$name; }
    }
    return $result;
}
*/


//WRITE CONFIG FILE
ob_start();

    require_once '_dev_templates/config/Project.php';
    
$code = ob_get_contents();
ob_end_clean();

$code = Model_TemplateFactory::translatePHP($code);

if(file_put_contents(APPLICATION_PATH.'/config/Project.php', $code))
{
    echo "\nConfig file has been written\n\n";
    
    __c()->clean();
}
else echo "\nERROR - writing config file\n\n";
