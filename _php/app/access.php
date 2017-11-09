<?php

/**
 * 
 * @param 'bool'|'redirect' $action
 * @param Array $requiredRoles role=>subrole,...
 * @return boolean
 */
function access($requiredRoles=null)
{
    $valid = false;
    
    
    
    //load current page access
    if($requiredRoles===null) {
        $requiredRoles = App::getIns()->currentPage()->getAccess()->getRolesArray();
        
    }

    //free page    
    if( $requiredRoles==null || !count($requiredRoles) ) $valid = true;
    
    //else we need login
    elseif( ! AppUser::isLogged() ) $valid = false;     
    
    //we need role and subrole
    else
    {    
        $reqRoles = array_keys($requiredRoles);
                
        foreach($reqRoles as $key=>$reqRole)
        if(  AppUser::getIns()->hasRole($reqRole) )
        {
                $reqSubrole = $requiredRoles[$reqRole];
                $reqSubroleRank = AppUserRoles::getIns()->getSubroleRank($reqRole,$reqSubrole);
                if(AppUser::getIns()->getSubRole($reqRole)->getRank()->getValue()>=$reqSubroleRank)
                    { $valid = true; break; }                
        }
             
    }
    
    
    return $valid;    
}
