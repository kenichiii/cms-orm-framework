<?php

class AppAlert
{
    public static function set($str)
    {
        AppSess::set('flash_alert', $str);
    }
    
    public static function get()
    {
        $msg = isset(AppSess::$p['flash_alert'])&&AppSess::$p['flash_alert']!=''?AppSess::$p['flash_alert']:null;
        self::clear();
        return $msg;
    }
    
    public static function clear()
    {
        AppSess::set('flash_alert',null);
    }
}
