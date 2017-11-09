[[

  //get filters  
    $<?php echo $grid->getName(); ?>_per_page = isset($_GET['showPerPage'])?$_GET['showPerPage']:6;            
    $<?php echo $grid->getName(); ?>_limit = isset($_GET['limit'])
                                            ? $_GET['limit']
                                            :(isset(AppSess::$p['<?php echo $grid->getName(); ?>_paging'])?AppSess::$p['<?php echo $grid->getName(); ?>_paging']
                                            :0);            
                                            
    <?php if($grid->getModel()->isOwnerIdAble()) { ?>$<?php echo $grid->getName(); ?>_ownerId = $_GET['ownerid'];<?php } ?>
    <?php if($grid->getModel()->isParentIdAble()) { ?>$<?php echo $grid->getName(); ?>_parentId = $_GET['parentid'];<?php } ?>    
    
    <?php if($grid->getModel()->isLangAble()) { ?>$<?php echo $grid->getName(); ?>_lang = $_GET['lang'];<?php } ?>
    
  //create grid and assign filters
    $<?php echo $grid->getName(); ?>_grid = new <?php echo $class; ?>();
    $<?php echo $grid->getName(); ?>_data = $<?php echo $grid->getName(); ?>_grid    
                <?php if($grid->getModel()->isDeletedAble()) { ?>->setDeletedCond()<?php } ?>
                
                <?php if($grid->getModel()->isLangAble()) { ?>->setLangCond($<?php echo $grid->getName(); ?>_lang)<?php } ?>
                
                <?php if($grid->getModel()->isOwnerIdAble()) { ?>->setOwnerIdCond($<?php echo $grid->getName(); ?>_ownerId)<?php } ?><?php if($grid->getModel()->isParentIdAble()) { ?>->setParentIdCond($<?php echo $grid->getName(); ?>_parentId)<?php } ?>
                
                <?php if($grid->getModel()->isRankAble()) { ?>->setRankOrderByCond()<?php } ?>
                
           ->limit($<?php echo $grid->getName(); ?>_limit,$<?php echo $grid->getName(); ?>_per_page)         
         ;  
         
  //load data from grid  
    $<?php echo $grid->getName(); ?>_data = $<?php echo $grid->getName(); ?>_grid->getData();
    
  //get data count all   
    $<?php echo $grid->getName(); ?>_count = $<?php echo $grid->getName(); ?>_grid->getCount();    
    $showcount = !isset($_GET['limit']) ? true : false; 
  
  //get grid data pagination    
    $<?php echo $grid->getName(); ?>_base_params = array();
    <?php if($grid->getModel()->isOwnerIdAble()) { ?>$<?php echo $grid->getName(); ?>_base_params['ownerid']=$<?php echo $grid->getName(); ?>_ownerId;<?php } ?>
    <?php if($grid->getModel()->isParentIdAble()) { ?>$<?php echo $grid->getName(); ?>_base_params['parentid']=$<?php echo $grid->getName(); ?>_parentId;<?php } ?>    
    
    <?php if($grid->getModel()->isLangAble()) { ?>$<?php echo $grid->getName(); ?>_base_params['lang']=$<?php echo $grid->getName(); ?>_lang;<?php } ?>
        
    
    AppSess::set('<?php echo $grid->getName(); ?>_paging', $<?php echo $grid->getName(); ?>_limit);
    if((!isset($_GET['limit'])||isset($_GET['previos']))&&AppSess::$p['<?php echo $grid->getName(); ?>_paging']>=$<?php echo $grid->getName(); ?>_per_page)
    {
        $showPreviosPaging = true;
        $<?php echo $grid->getName(); ?>_previos_params = $<?php echo $grid->getName(); ?>_base_params;
        $<?php echo $grid->getName(); ?>_previos_params['previos']='1';
        $<?php echo $grid->getName(); ?>_previos_params['limit']=$<?php echo $grid->getName(); ?>_limit-$<?php echo $grid->getName(); ?>_per_page;
        
    }
    else $showPreviosPaging = false;
    
    if(!isset($_GET['previos']) && ($<?php echo $grid->getName(); ?>_limit+$<?php echo $grid->getName(); ?>_per_page)<$<?php echo $grid->getName(); ?>_count)
    {        
        $showpaging = true;
        $<?php echo $grid->getName(); ?>_params = $<?php echo $grid->getName(); ?>_base_params;
        $<?php echo $grid->getName(); ?>_params['limit']=$<?php echo $grid->getName(); ?>_limit+$<?php echo $grid->getName(); ?>_per_page;        
    }
    else
    {
        $showpaging = false;
    }
    
    
 //run template   
    require '_templates/<?php echo $grid->getName(); ?>.list.php';
    
    