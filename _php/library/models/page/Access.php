<?php

class Page_Access extends Model_Primitive_Varchar
{
    public function getRolesArray()
    {                
        if($this->_value==null||$this->_value=='') return null;
        
        $roles = array();
        
            foreach( explode(',',$this->_value) as $key=>$roleWithSubrole )
            {
                $r = explode('::',$roleWithSubrole );
                if(isset($r[1]))
                {
                    $roles [$r[0]]=$r[1];
                }
                else $roles [$r[0]]=null;
            }
        
        return $roles;    
    }
    
}
