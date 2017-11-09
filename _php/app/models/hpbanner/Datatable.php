<?php

class HPBanner_Datatable extends Model_Component_Datatable_dataGrid 
{
    
    public $PER_PAGE = 15;

    public $table = "hpbanners";
    public $tableRaw = "hpbanners";

    public $htmlID = "hpbanners";

    protected $primaryKey = "id";
    
    
    protected $where    = "  WHERE deleted=0  ";
    protected $orderBy	= "  ORDER BY rank DESC  ";

    
    
    
    
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
            "title_cz" => "Název",
            "model" => "text",
            "filter" => "text",
            
                        
                        
                        
                                    
                                                
        ),
                                                                             
        "photo" => array(
            "title_cz" => "Foto",
            "model" => "text",
            "filter" => "text",
            
            "not-sortable"=>true,
            
                        
            
            "render"=>"renderFoto",
                        
                        
                                    
                                                
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
               
                 "moveup" => array(
                     "title_cz" => "Nahoru",
                     "class" => "moveUp" ,
                     "pointer" => App::getIns()->currentPage()->getPointer()->getValue(),
                     "icon"    => "	ui-icon-arrowthick-1-n"
                   ),
                 "movedown" => array(
                     "title_cz" => "Dolů",
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

                        

                        

            
    
      public function renderFoto($rowClass) {
        return 
          $rowClass->photo!=''
              ? '<img src="'. Magick_Factory::thumb( '/docs/homebanner/photo/'. $rowClass->photo, 120, 120) .'">'
              : '---'  
          ;
      }
      
                        

                        

    
    
}



