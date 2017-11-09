<?php

class News_Datatable extends Model_Component_Datatable_dataGrid
{
    
    public $PER_PAGE = 15;

    public $table = ":db:news";
    public $tableRaw = ":db:news";

    public $htmlID = "news";

    protected $primaryKey = "id";
    
    
    protected $where    = "  WHERE deleted=0 ";
    protected $orderBy	= "  ORDER BY [date] DESC,id DESC";

    
    
    
    
    public $model = array(
        "id" => array(
            "title_cz" => "Id",
            "model" => "key",
            "filter" => "key",
            
                        
                        
                        
                                    
                                                
        ),
        
         "active" => array(
            "title_cz" => "Aktivní",
            "model" => "bit",
            "filter" => "bit",
            
                        
                        
                        
                                    
                                                
        ),
        
        
        "h1" => array(
            "title_cz" => "Nadpis",
            "model" => "text",
            "filter" => "text",
            
                        
                        
                        
                                    
                                                
        ),
                                                                             
        "date" => array(
            "title_cz" => "Datum",
            "model" => "date",
            "filter" => "date",
            
                        
                        
                        
                                    
                                                
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

                        

                        

                        

    
    
}



