[[

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
    public static $image = <?php echo $image; ?>;

    /*
    *   Project
    */
    public static $title = '<?php echo $title; ?>';    
    public static $name = '<?php echo $name; ?>';
    
    /*
    *  Web address
    */
    public static $WEB_URL = '<?php echo $weburl; ?>';
    
    
    /*
    *  DATABASE 
    */
    public static $databaseConfig = array(
        'driver' => 'mysql', 
        'host' => '<?php echo $db_hostname; ?>', 
        'username' => '<?php echo $db_username; ?>', 
        'password' => '<?php echo $db_password; ?>', 
        'database' => '<?php echo $db_database; ?>', 
        'debug' => false, 
        'charset' => 'utf8', 
        "profiler" => false
    );
    public static $databasePrefix = '<?php echo $db_prefix; ?>';

    /*
    *  Project languages
    */
    public static $languages = array('<?php echo implode("','",explode(',',$langs)); ?>');
    
    
    /*
    *  Admin languages
    */
   public static $adminlanguages = array('<?php echo implode("','",explode(',',$adminlangs)); ?>');
    
   /**
    * translations default src lang
    */
    public static $DEV_TRANS_LANG = "<?php echo $devlang; ?>";
    
    /*
    *  MAGICK THUMB ALLOWED SIZES
    */
    public static $allowedThumbs = array(<?php echo $povolenerozmery; ?>); 
    
    
    /*
    *   System emails
    */
            //catched Exception reporting recepient
    public static $crashmail = '<?php echo $crashemail; ?>';
    
            //AppMail default from
    public static $infomail = '<?php echo $infoemail; ?>';
    
    
    /*
    *  System passwords
    */
            //dev-install + basic database generated admin account
    public static $installAuthLogin = "<?php echo $installauthlogin; ?>";        
    public static $installAuthPwd = "<?php echo $installauthpwd; ?>";
    
            //IMAGE_DEV password
    public static $basicAuthPwd = "<?php echo $basicauthpwd; ?>";
   
        
   /*
    * APP error reporting
    */      
    public static $displayErrors = <?php echo $displayerrors; ?>;
    public static $errorReporting = <?php echo $errorreportimg; ?>;  
   
    
    
   /*
    *   .HTACCESS generator settings
    */
        //allowed files extensions
   public static $allowedFiles = "<?php echo $allowedfiles; ?>"; 
        
        //.hataccess force www
   public static $htaccess_force_www = <?php echo $htaccess_force_www == 'yes' ? 'true' : 'false'; ?>;
        
        
   /*
    *  PHP INI UPLOADS 
    */
    public static $upload_max_filesize = "<?php echo $upload_max_filesize; ?>";
    public static $post_max_size = "<?php echo $post_max_size; ?>";

    
    /*
     * SERVER TIMEZONE
     */
    public static $default_timezone = "<?php echo $default_timezone; ?>";    


    /*
     * PHP INI session cache expire
     */
    public static $session_cache_expire = <?php echo $session_cache_expire; ?>;         
            
    
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

