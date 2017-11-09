<?php

class Reference_Datatable extends Model_Component_Datatable_dataGrid
{
    
    public $PER_PAGE = 15;

    public $table = ":db:reference";
    public $tableRaw = ":db:reference";

    public $htmlID = "refs";

    protected $primaryKey = "id";
    
    
    protected $where    = "  WHERE deleted=0  ";
    protected $orderBy	= "  ORDER BY rank DESC, id DESC  ";

    
    
    
    
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
                                                                             
        "created" => array(
            "title_cz" => "Vytvořena",
            "model" => "datetime",
            "filter" => "datetime",
            
                        
                        
                        
                                    
                                                
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
               
  
                   
                 "moveup" => array(
                     "title_cz" => "Posunout nahoru",
                     "class" => "moveUp" ,
                     "pointer" => App::getIns()->currentPage()->getPointer()->getValue(),
                     "icon"    => "	ui-icon-arrowthick-1-n"
                   ),
                 "movedown" => array(
                     "title_cz" => "Posunout dolů",
                     "class" => "moveDown" ,
                     "pointer" => App::getIns()->currentPage()->getPointer()->getValue(),
                     "icon"    => " ui-icon-arrowthick-1-s"
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



