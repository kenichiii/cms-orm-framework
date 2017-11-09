[[

class <?php echo $class; ?> extends <?php echo $extends ?>

{
<?php if($rowClass!=''){?>
    protected $rowClass = "<?php echo $rowClass; ?>";
<?php } ?>
    
    public $PER_PAGE = <?php echo $perPage; ?>;

    public $table = "<?php echo $table; ?>";
    public $tableRaw = "<?php echo $tableRaw; ?>";

    public $htmlID = "<?php echo $htmlID; ?>";

<?php if($primaryKey!=''){?>
    protected $primaryKey = "<?php echo $primaryKey; ?>";
<?php } ?>    
    
    protected $where    = " <?php echo $where; ?> ";
    protected $orderBy	= " <?php echo $orderBy; ?> ";

<?php if($limit!=''){?>
    protected $limit = "<?php echo $limit; ?>";
<?php } ?>
<?php if($groupBy!=''){?>
    protected $groupBy = "<?php echo $groupBy; ?>";
<?php } ?>
    
<?php if(trim($collums)!='array("*")'){?>
    protected $collums = <?php echo $collums; ?>;
<?php } ?>
    
    
    
    public $model = array(
<?php        
                    
                foreach($collum_name as $ckey => $cName  )
                {
                    if($cName)
                    {
?>
        "<?php echo $cName; ?>" => array(
            "title_cz" => "<?php echo $collum_title[$ckey] ?>",
            "model" => "<?php echo $collum_model[$ckey] ?>",
            "filter" => "<?php echo $collum_filter[$ckey] ?>",
<?php if($collum_sortable[$ckey]>0) { ?>            
            "not-sortable"=>true,
<?php } ?>            
<?php if($collum_table[$ckey]!='') { ?>            
            "table"=>"<?php echo $collum_table[$ckey]; ?>",
<?php } ?>                        
<?php if($collum_render[$ckey]!='') { ?>            
            "render"=>"<?php echo $collum_render[$ckey]; ?>",
<?php } ?>                        
<?php if($collum_where[$ckey]!='') { ?>            
            "where"=>"<?php echo $collum_where[$ckey]; ?>",
<?php } ?>                        
<?php if($collum_customFunction[$ckey]!='') { ?>            
            "custom_function"=>"<?php echo $collum_customFunction[$ckey]; ?>",
<?php } ?>                                                
<?php if($collum_filter[$ckey]=='select'&&$fromGrid) { 
    
        $g = new $fromGrid();
    ?>            
            "values"=>array(
                "none"=>array("cz"=>"vše"),
             <?php foreach($g->getModel()->get($cName)->getTypesRaw() as $type) { ?>   
                "<?php echo $type; ?>"=>array("cz"=>"<?php echo $g->getModel()->get($cName)->getType($type); ?>"),
             <?php } ?>   
            ),
<?php }               
      elseif($collum_filter[$ckey]=='select') { ?>            
            "values"=>array(
                "none"=>array("cz"=>"vše"),
            ),
<?php } ?>                                                
        ),
                                                                             
<?php
                     }
                } //endforeach
?>    
    ); //end model

    protected $checkBoxActions = array(    
<?php foreach($groupaction_name as $gaKey => $gaName) { 

            if($gaName) {
    ?>
            "<?php echo $gaName; ?>" => array(
                "title_cz" => "<?php echo $groupaction_title[$gaKey]; ?>",             
            ), 

<?php } } ?>                
    );
    
               
    
    public function  __construct( $filters = null, $autoload = true ) {

            $this->actions = array(
<?php if(isset($createactionedit)) { ?>
                "edit" => array(   
                   "title_cz" => "<?php echo $actionedit_title; ?>",
                   "class" => "actionEdit",
                   "pointer" => App::getIns()->currentPage()->getPointer()->getValue(),
                   "icon"    => "ui-icon-folder-open"
                    ),
<?php } ?>               
<?php foreach($action_name as $aKey => $aName) { 
    
        if($aName) {

?>
                 "<?php echo $aName; ?>" => array(
                     "title_cz" => "<?php echo $action_title[$aKey]; ?>",
                     "class" => "<?php echo $action_class[$aKey]; ?>" ,
                     "pointer" => <?php echo $action_pointer[$aKey]=='_curr'?"App::getIns()->currentPage()->getPointer()->getValue()":'"'.$action_pointer[$aKey].'"'; ?>,
                     "icon"    => "<?php echo $action_icon[$aKey]; ?>"
                   ),
<?php }} ?>  
<?php if(isset($createactionrank)) { ?>                   
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
<?php } ?>                                    
<?php if(isset($createactiondelete)) { ?>                   
                 'delete' => array(
                     "title_cz" => "<?php echo $actiondelete_title; ?>",
                     "class" => "actionDelete" ,
                     "pointer" => App::getIns()->currentPage()->getPointer()->getValue(),
                     "icon"    => "ui-icon-trash"                    
                 ),
<?php } ?>                 
               ); //end actions

    
    
        parent::__construct( $filters, $autoload );
    } //end constructor

<?php        
                    
                foreach($collum_name as $ckey => $cName  )
                {
                    if($cName)
                    {
?>
<?php if($collum_render[$ckey]!='') { ?>            

<?php if($fromGrid) { 
        $g = new $fromGrid();
        
        
     if($g->getModel()->get($cName) instanceof Model_Extended_Photo)
     {
    ?>

      public function <?php echo $collum_render[$ckey]; ?>($rowClass) {
         return 
          $rowClass-><?php echo $cName; ?>!=''
              ? '<img src="'. Magick_Factory::thumb( '/<?php echo $g->getModel()->get($cName)->getDir(); ?>/'. $rowClass-><?php echo $cName; ?>, 120, 120) .'">'
              : '---'  
          ;
      }
    
<?php } elseif($g->getModel()->get($cName) instanceof Model_Extended_Price) { ?>      
      
      public function <?php echo $collum_render[$ckey]; ?>($rowClass) {
        return $rowClass-><?php echo $cName; ?>.' Kč';
      }      
      
<?php } elseif($g->getModel()->get($cName) instanceof Model_Primitive_Text) { ?>      
      
      public function <?php echo $collum_render[$ckey]; ?>($rowClass) {
        return perex($rowClass-><?php echo $cName; ?>,70);
      }      
      
<?php } ?>    
      
      
      
<?php } else { ?>    
      
      public function <?php echo $collum_render[$ckey]; ?>($rowClass) {
        return ;
      }
      
<?php } ?>  
      
<?php } ?>                        
<?php if($collum_customFunction[$ckey]!='') { ?>            
      
      public function <?php echo $collum_customFunction[$ckey]; ?>($value) {
        return;
      }
      
<?php } ?>

<?php               }  

                } //endforeach
?>
    
    
}



