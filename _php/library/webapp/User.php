<?php

class AppUser extends User_Model
{
    protected static $ins = null;
    
    /**
     * 
     * @return AppUser
     */
    public static function getIns()
    {
        if( self::$ins === null)
        {
            if(self::isLogged())
            {
              $id = AppSess::$p["sm_user"];  
              $ckey = 'appuser-'.$id;
              
              $ins = __c()->get($ckey);  
              
              if($ins==null)
              {
                  $grid = new User_Grid();                
                  $ins = $grid->getByPk($id);
                  __c()->set($ckey,$ins,60*30);                  
              }
              
              self::$ins = $ins;
            }
            
        }
        
        return self::$ins;
    }    
    
    public static function login( $login, $password )
    {                
        if( $userid = self::getIdByLogin($login, $password) )
        {
            AppSess::set("sm_user",$userid);
            return $userid;
        }
        else return false;
    }
    
   /**
     * return database id for current login and password
     * 
     * @param type $login
     * @param type $password
     * @return int primary key
     */
    public static function getIdByLogin($login, $password)
    {

        $grid = new User_Grid();
        $id = User_Grid::getConn()->fetchSingle("select id from {$grid->getTableRaw()} where login=%s and pwd=%s",$login, AppUser::encodePwd(trim($password)));

        return $id;
    }
    
    public static function isLogged()
    {
        return ( isset(AppSess::$p["sm_user"]) && AppSess::$p["sm_user"] > 0 ) ? true : false;
    }

    public static function logout()
    {
        AppSess::set("sm_user",null);        
    }
    
    public static function encodePwd($string)
    {
        return md5($string);
    }
}
