<?php

class HPZnacky_Datatable extends Model_Component_Datatable_dataGrid
{

    public $PER_PAGE = 15;

    public $table = "[:db:hpznacky] as [hpz]";
    public $tableRaw = ":db:hpznacky";

    public $htmlID = "hpznacky_datatable";

    protected $primaryKey = "[hpz].[id]";

    protected $where    = "  WHERE [hpz].[deleted]=0  ";
    protected $orderBy	= "  ORDER BY [hpz].[rank] ASC ";

    protected $collums = array("[hpz].[id] as [id]","[hpz].[rank] as [rank]","[hpz].[deleted] as [deleted]","[hpz].[active] as [active]","[hpz].[h1] as [h1]","[hpz].[uri] as [uri]","[hpz].[content] as [content]","[hpz].[photo] as [photo]","[hpz].[created] as [created]");

    public $model = array(
        "id" => array(
            "title_cz" => "Id",
            "model" => "key",
            "filter" => "key",

            "where"=>"[hpz].[id]",

        ),


        "active" => array(
            "title_cz" => "Aktivní",
            "model" => "bit",
            "filter" => "bit",

            "where"=>"[hpz].[active]",

        ),

        "h1" => array(
            "title_cz" => "Nadpis",
            "model" => "text",
            "filter" => "text",

            "where"=>"[hpz].[h1]",

        ),

        "photo" => array(
            "title_cz" => "Hlavní foto",
            "model" => "text",
            "filter" => "text",

            "render"=>"renderphoto",

            "where"=>"[hpz].[photo]",

        ),

        "created" => array(
            "title_cz" => "Datum vytvoření",
            "model" => "datetime",
            "filter" => "datetime",

            "where"=>"[hpz].[created]",

        ),

    ); //end model

    protected $checkBoxActions = array(    

    );

    public function  __construct( $filters = null, $autoload = true ) {

            $this->actions = array(
                "edit" => array(   
                   "title_cz" => "Upravit",
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

      public function renderphoto($rowClass) {
         return 
          $rowClass->photo!=''
              ? '<img src="'. Magick_Factory::thumb( '/docs/hpznacky/photo/'. $rowClass->photo, 120, 120) .'">'
              : '---'  
          ;
      }

}

