<?php

class AppUserRoles extends Model_Model
{
    protected static $ins = null;
    
    protected $map = array();
    
    
    public static function getIns()
    {
        if(self::$ins===null)
        {
          $ins = __c()->get('appuserroles');
          if($ins==null||! $ins instanceof AppUserRoles)
          {
              $ins = new AppUserRoles();
               __c()->set('appuserroles',$ins,  AppCacheConfig::$APP_USER_ROLES_LF);
          }
           
          self::$ins = $ins;
        }
        
        return self::$ins;
    }        
    
    public function __construct()
    {        
        $grid = new User_Role_Grid();
        
        foreach($grid->getData() as $key=>$role)
        {
            $role->arraysubroles = $role->getSubroles()->getData();
            $this->map [$role->getPointer()->getValue()]= $role;            
        }
    }    
    
    public function registerRole($role,$subrole,$userid)
    {
        $roleid = $this->map [$role]->getId()->getValue();
        
        foreach($this->map [$role]->arraysubroles as $key=>$s)
            if($s->getPointer()->getValue()==$subrole)
            {
                $subroleid = $s->getId()->getValue();
                break;
            }
        
        if(!isset($subroleid)) throw new Exception("cant register {$role}::{$subrole} ");    
        
        return self::registerRoleByIds($roleid, $subroleid, $userid);
    }    

    public static function registerRoleByIds($roleid,$subroleid,$userid)
    {
        $grid = new User_Roles_Grid();                
        return User_Roles_Grid::getConn()->query('INSERT INTO '.$grid->getTableRaw().' (userid,roleid,subroleid) VALUES (%i,%i,%i)',$userid,$roleid,$subroleid);
    }    
    
    
    public function unregisterRole($role,$subrole,$userid)
    {
        $roleid = $this->map [$role]->getId()->getValue();
        foreach($this->map [$role]->arraysubroles as $key=>$s)
            if($s->getPointer()->getValue()==$subrole)
            {
                $subroleid = $s->getId()->getValue();
                break;
            }
        
        if(!isset($subroleid)) throw new Exception("cant unregister {$role}::{$subrole} ");    
        
        return self::unregisterRoleByIds($roleid, $subroleid, $userid);        
    }    
    public static function unregisterRoleByIds($roleid,$subroleid,$userid)
    {
        $grid = new User_Roles_Grid();                
        return User_Roles_Grid::getConn()->query('DELETE FROM '.$grid->getTableRaw().' WHERE userid=%i and roleid=%i and subroleid=%i',$userid,$roleid,$subroleid);        
    }    
    public static function unregisterRoleIdWhole($roleid,$userid)
    {
        $grid = new User_Roles_Grid();                
        return User_Roles_Grid::getConn()->query('DELETE FROM '.$grid->getTableRaw().' WHERE userid=%i and roleid=%i',$userid,$roleid);        
    }    
    
    
    public function getMap($name)
    {
        return $this->map;
    }    
    
    public function getRole($name)
    {
        return $this->map[$name];
    }
    
    public function getSubrole($role,$subrole)
    {
        if(isset($this->map [$role]))
            foreach( $this->map [$role]->arraysubroles as $key=>$sub)
            {
                if($sub->getPointer()->getValue()==$subrole) return $sub;
            }
        else throw new Exception("Role {$role} dont exists");
        
        throw new Exception("Role {$role} dont have subrole {$subrole}");
    }    
    
    public function getSubroleRank($role,$subrole)
    {
        if(isset($this->map [$role]))
            foreach( $this->map [$role]->arraysubroles as $key=>$sub)
            {
                if($sub->getPointer()->getValue()==$subrole) return $sub->getRank()->getValue();
            }
        else throw new Exception("Role {$role} dont exists");
        
        throw new Exception("Role {$role} dont have subrole {$subrole}");
    }
    
    public static function loadUserRoleByRoleId($roleid,$userid)
    {
            $urgrid = new User_Roles_Grid();
            return $urgrid
               ->where('and '.$urgrid->getAlias('userid').'=%i',$userid)
               ->where('and '.$urgrid->getAlias('roleid').'=%i',$roleid)
             ->getSingle(); 
            
    }
    
    public static function loadUserRolesByUserId($userid)
    {
            $urgrid = new User_Roles_Grid();
            return $urgrid
                 ->where('and '.$urgrid->getAlias('userid').'=%i',$userid)
               ->getData(); 
            
    }
    
}
