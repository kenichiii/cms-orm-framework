<?php

class AppMenu {

    public static function get($parentId = 0)
    {
        $active = modelspk2array(App::getIns()->getPageTree());
                
        $menu = array();
        foreach (App::getIns()->getPages() as $key=>$page)
        {
           if( $page->getParentId()->getValue()==$parentId
            && $page->getShowInMenu()->getValue()==1
            && access($page->getAccess()->getRolesArray()) ) 
              $menu []= array(
                'page' => $page,
                'active' => in_array ($page->getId()->getValue(), $active)                
            );                                      
        }
        
        
        return $menu;
    }
    
    public static function getfooter()
    {
        $active = modelspk2array(App::getIns()->getPageTree());
                
        $menu = array();
        foreach (App::getIns()->getPages() as $key=>$page)
        {
           if( $page->getFootermenu()->getValue()==1 && access($page->getAccess()->getRolesArray()) ) 
              $menu []= array(
                'page' => $page,
                'active' => in_array ($page->getId()->getValue(), $active)
            );                                      
        }
        
        return $menu;
    }
    
}
