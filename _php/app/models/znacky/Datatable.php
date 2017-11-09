<?php

class Znacky_Datatable extends Model_Component_Datatable_dataGrid
{
    
    public $PER_PAGE = 15;

    public $table = "znacky";
    public $tableRaw = "znacky";

    public $htmlID = "znacky";

    protected $primaryKey = "id";
    
    
    protected $where    = "  WHERE deleted=0 ";
    protected $orderBy	= "  ORDER BY h1 ASC ";

    
    
    
    
    public $model = array(
        "id" => array(
            "title_cz" => "Id",
            "model" => "key",
            "filter" => "key",
            
                        
                        
                        
                                    
                                                
        ),
                                                                             
        "photo" => array(
            "title_cz" => "Logo",
            "model" => "text",
            "filter" => "text",
            
                        
            
            "render"=>"renderFoto",
                        
                        
                                    
                                                
        ),
                                                                             
        "h1" => array(
            "title_cz" => "Název",
            "model" => "text",
            "filter" => "text",
            
                        
                        
                        
                                    
                                                
        ),
                                                                             
        "active" => array(
            "title_cz" => "Aktivní",
            "model" => "bit",
            "filter" => "bit",
            
                        
                        
                        
                                    
                                                
        ),
                                                                             
        "link" => array(
            "title_cz" => "Odkaz",
            "model" => "text",
            "filter" => "text",
            
                        
                        
                        
                                    
                                                
        ),
                                                                             
    
    ); //end model

    protected $checkBoxActions = array(    
                
    );
    
               
    
    public function  __construct( $filters = null, $autoload = true ) {

            $this->actions = array(
                "edit" => array(   
                   "title_cz" => "Editovat",
                   "class" => "actionEdit",
                   "pointer" => App::getIns()->currentPage()->getPointer()->getValue(),
                   "icon"    => "ui-icon-folder-open"
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

                        

            
    
      public function renderFoto($rowClass) {
        return 
          $rowClass->photo!=''
              ? '<img src="'. Magick_Factory::thumb( '/docs/znacky/photo/'. $rowClass->photo, 50, 50) .'">'
              : '---'  
          ;
      }
      
                        

                        

                        

                        

    
    
}



