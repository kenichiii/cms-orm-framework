<?php

class Admins_Datatable extends Model_Component_Datatable_dataGrid 
{
    protected $rowClass = "Admins_Row";
    
    public $PER_PAGE = 15;

    public $table = ":db:users as u left join :db:usersubjects as s on s.id=u.subjectid left join :db:users2roles as u2r on u2r.userid=u.id left join :db:userssubroles as sb on sb.id=u2r.subroleid";
    public $tableRaw = ":db:users";

    public $htmlID = "admins";

    protected $primaryKey = "u.id";
    
    protected $collums = array('u.*,s.h1 as subject,sb.h1 as subrole');
    
    protected $orderBy	= "  ORDER BY u.id DESC  ";

    
    
    
    
    public $model = array(
        "id" => array(
            "title_cz" => "ID",
            "model" => "key",
            "filter" => "key",
            "table" => "u",
        ) ,
        
        
        "fullname_surname" => array(
            "title_cz" => "Jméno",
            "model" => "text",
            "filter" => "text",
            "table" => "u",
            "render" => "renderFullname"
        ) ,
        
        "login" => array(
            "title_cz" => "Login",
            "model" => "text",
            "filter" => "text",
            "table" => "u",
                        
                        
                        
                                    
                                                
        ),
                                                                             
        "email" => array(
            "title_cz" => "Email",
            "model" => "text",
            "filter" => "text",
            "table" => "u",                                                
        ),

        "subrole" => array(
            "title_cz" => "Přístup",
            "model" => "text",
            "filter" => "text",
            "where" => "sb.h1"
        ),                
        
        "subject" => array(
            "title_cz" => "Skupina",
            "model" => "text",
            "filter" => "text",                                                
            "where" => "s.h1"            
        ),        
    
    ); //end model

    protected $checkBoxActions = array(    
                
    );
    
               
    
    public function  __construct( $filters = null, $autoload = true ) {


        $this->where    = "  WHERE u.deleted=0 and u2r.roleid=".AppUserRoles::getIns()->getRole("admin")->getId()->getValue().' ';
        
        
        
            $this->actions = array(
                "edit" => array(   
                   "title_cz" => "Editovat",
                   "class" => "actionEdit",
                   "pointer" => App::getIns()->currentPage()->getPointer()->getValue(),
                   "icon"    => "ui-icon-folder-open"
                    ),
               
                 "password" => array(
                     "title_cz" => "Změna hesla",
                     "class" => "actionPwdChange" ,
                     "pointer" => App::getIns()->currentPage()->getPointer()->getValue(),
                     "icon"    => "ui-icon-locked"
                   ),
  
                   
                 'delete' => array(
                     "title_cz" => "Smazat",
                     "class" => "actionDelete" ,
                     "pointer" => App::getIns()->currentPage()->getPointer()->getValue(),
                     "icon"    => "ui-icon-trash"                    
                 ),
                 
               ); //end actions

    
    
        parent::__construct( $filters, $autoload );
    } //end constructor

                        

    public function renderFullname($rowClass) {
        return $rowClass->fullname_titlesbefore.' '.$rowClass->fullname_firstname.' '.$rowClass->fullname_surname.' '.$rowClass->fullname_titlesafter;
    }                    

                          
}



