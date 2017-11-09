<?php

//define Project image types
define('IMAGE_PROD','PROD');
define('IMAGE_DEV','DEV');
define('IMAGE_LOCAL','localhost');

/*
*  Current application settings
*/
class Project
{
    /*
    *   ENVIROMENT
    */
    public static $image = IMAGE_DEV;

    /*
    *   Project
    */
    public static $title = 'Sandbox website';    
    public static $name = 'website';

    /*
    *  Web address
    */
    public static $WEB_URL = 'http://domain.name';

    /*
    *  DATABASE 
    */
    public static $databaseConfig = array(
        'driver' => 'mysql', 
        'host' => 'localhost', 
        'username' => 'root', 
        'password' => '', 
        'database' => 'dbname', 
        'debug' => false, 
        'charset' => 'utf8', 
        "profiler" => false
    );
    public static $databasePrefix = '';

    /*
    *  Project languages
    */
    public static $languages = array('cz');

    /*
    *  Admin languages
    */
   public static $adminlanguages = array('cz');

   /**
    * translations default src lang
    */
    public static $DEV_TRANS_LANG = "cz";

    /*
    *  MAGICK THUMB ALLOWED SIZES
    */
    public static $allowedThumbs = array("50x50","120x120","250x250","460x400","800x600","1100x800"); 

    /*
    *   System emails
    */
            //catched Exception reporting recepient
    public static $crashmail = 'kena1@email.cz';

            //AppMail default from
    public static $infomail = 'info@kena23.cz';

    /*
    *  System passwords
    */
            //dev-install + basic database generated admin account
    public static $installAuthLogin = "webmaster";        
    public static $installAuthPwd = "d3v3l0p3r";

            //IMAGE_DEV password
    public static $basicAuthPwd = "demo";

   /*
    * APP error reporting
    */      
    public static $displayErrors = 1;
    public static $errorReporting = E_ALL;  

   /*
    *   .HTACCESS generator settings
    */
        //allowed files extensions
   public static $allowedFiles = "js|ico|gif|jpg|png|htm|css|flv|swf|pdf|zip|doc|xls|xml|html|f4v|txt|woff|ttf"; 

        //.hataccess force www
   public static $htaccess_force_www = false;

   /*
    *  PHP INI UPLOADS 
    */
    public static $upload_max_filesize = "122M";
    public static $post_max_size = "128M";

    /*
     * SERVER TIMEZONE
     */
    public static $default_timezone = "Europe/Prague";    

    /*
     * PHP INI session cache expire
     */
    public static $session_cache_expire = 180;         

    /*
     * used in models validators
     */
    public static $images = array('jpg','png','gif');
    public static $videos = array('avi','mp4');

    /*
    * APP logic constants
    */
    public static $MAGICK_THUMB_GET_NAME = 'magickcacheimg';

    public static $DEV_INSTALL_URI = "dev-install";

    public static $HOME_PAGE_POINTER = "home";
    public static $HOME_PAGE_URI = "homepage";

    public static $ERROR404_PAGE_POINTER = "page404";
    public static $ERROR404_PAGE_URI = "error404";    

    public static $ADMIN_PAGE_POINTER = "admin";
    public static $ADMIN_PAGE_URI = "admin";    

}

