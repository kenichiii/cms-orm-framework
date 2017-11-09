<?php

class AppCacheConfig
{
    /*
     * phpfastcache settings
     */
    public static $CACHE_DIR = "_cache";//rewrited at the bottom
    public static $CACHE_STORAGE = "auto";// auto, files, sqlite, xcache, memcache, apc, memcached, wincache
    
    /*
     * page database table collum cachelifetime default value
     */
    public static $MODEL_PAGE_DEFAULT_LF = 1209600;//3600*24*14;
    
    /*
     * used in webapp/App.php loadPages
     */
    public static $APP_PAGES_LF = 1209600;//3600*24*14;

    /*
     * used in webapp/User.php getIns
     */
    public static $APP_USER_LF = 3600;//60*60;

    /*
     * used in webapp/UserRoles.php get
     */
    public static $APP_USER_ROLES_LF = 1209600;//3600*24*14;   
    
    
    /*
     * used in webapp/Settings.php loadBy
     */
    public static $SETTINGS_LF = 1209600;//3600*24*14;    
    
    /*
     * used in webapp/Translations.php get
     */
    public static $TRANSLATIONS_LF = 1209600;//3600*24*14;   
    
    
}

/*
 * rewrites
 */
AppCacheConfig::$CACHE_DIR = APPLICATION_PATH .'/'. AppCacheConfig::$CACHE_DIR;





