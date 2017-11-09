<?php

class Napiste_Datatable extends Model_Component_Datatable_dataGrid
{
    
    public $PER_PAGE = 15;

    public $table = ":db:napistenam";
    public $tableRaw = ":db:napistenam";

    public $htmlID = "napiste";

    protected $primaryKey = "id";
    
    
    protected $where    = "  WHERE deleted=0  ";
    protected $orderBy	= "  ORDER BY id DESC  ";

    
    
    
    
    public $model = array(
        "id" => array(
            "title_cz" => "Id",
            "model" => "key",
            "filter" => "key",
            
                        
                        
                        
                                    
                                                
        ),
                                                                             
        "jmeno" => array(
            "title_cz" => "Jméno",
            "model" => "text",
            "filter" => "text",
            
                        
                        
                        
                                    
                                                
        ),
                                                                             
        "email" => array(
            "title_cz" => "Email",
            "model" => "text",
            "filter" => "text",
            
                        
                        
                        
                                    
                                                
        ),
                                                                             
        "created" => array(
            "title_cz" => "Zaslána",
            "model" => "datetime",
            "filter" => "datetime",
            
                        
                        
                        
                                    
                                                
        ),
                                                                             
        "zprava" => array(
            "title_cz" => "Zpráva",
            "model" => "text",
            "filter" => "text",
            "render"=>"renderZprava"
                        
                        
                        
                                    
                                                
        ),
                                                                             
    
    ); //end model

    protected $checkBoxActions = array(    
                
    );
    
               
    
    public function  __construct( $filters = null, $autoload = true ) {

            $this->actions = array(
               
                 "view" => array(
                     "title_cz" => "Zobrazit",
                     "class" => "view" ,
                     "pointer" => App::getIns()->currentPage()->getPointer()->getValue(),
                     "icon"    => "ui-icon-script"
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

                        

                        
    public function renderZprava($rowClass)
    {
        return perex($rowClass->zprava,20);
    }
                        

                        

                        

    
    
}



