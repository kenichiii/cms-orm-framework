[[

  //get filters  
    $<?php echo $grid->getName(); ?>_limit = $_GET['limit'] = isset($_GET['limit'])?$_GET['limit']:0;
    $<?php echo $grid->getName(); ?>_per_page = $_GET['showPerPage'] = isset($_GET['showPerPage'])?$_GET['showPerPage']:6;            
    
  //create grid and assign filters
    <?php if($grid->getModel()->isOwnerIdAble()) { ?>$<?php echo $grid->getName(); ?>_ownerId = 1;<?php } ?>
    <?php if($grid->getModel()->isParentIdAble()) { ?>$<?php echo $grid->getName(); ?>_parentId = 0;<?php } ?>
    $<?php echo $grid->getName(); ?>_grid = new <?php echo $gridclass; ?>();
    $<?php echo $grid->getName(); ?>_grid    
                <?php if($grid->getModel()->isDeletedAble()) { ?>->setDeletedCond()<?php } ?><?php if($grid->getModel()->isActiveAble()) { ?>->setActiveCond()<?php } ?>
                
                <?php if($grid->getModel()->isLangAble()) { ?>->setLangCond(App::getIns()->getLang())<?php } ?>
                
                <?php if($grid->getModel()->isOwnerIdAble()) { ?>->setOwnerIdCond($<?php echo $grid->getName(); ?>_ownerId)<?php } ?><?php if($grid->getModel()->isParentIdAble()) { ?>->setParentIdCond($<?php echo $grid->getName(); ?>_parentId)<?php } ?>
                
                <?php if($grid->getModel()->isRankAble()) { ?>->setRankOrderByCond('DESC')<?php } ?>
                
           ->limit($<?php echo $grid->getName(); ?>_limit,$<?php echo $grid->getName(); ?>_per_page)         
         ;  
         
  //load data from grid  
    $<?php echo $grid->getName(); ?>_data = $<?php echo $grid->getName(); ?>_grid->getData();
    
  //get data count all   
    $<?php echo $grid->getName(); ?>_count = $<?php echo $grid->getName(); ?>_grid->getCount();
    
  //get grid data pagination  
                $<?php echo $grid->getName(); ?>_paging = paging($<?php echo $grid->getName(); ?>_count, array(
                    'limit_period' => $<?php echo $grid->getName(); ?>_per_page,
                    'paging_show'  => 9,
                    'limit' => $<?php echo $grid->getName(); ?>_limit,
                    'uri' => App::getIns()->setLink(App::getIns()->currentPage()->getPointer()->getValue()),
                    'params'=>''
                ));

  //set unique page title with paging  
    $pagetree = App::getIns()->getPageTree();
    $lastindex = count($pagetree)-1;
    App::getIns()->setPageTreePage($lastindex,'h1',
            $pagetree[$lastindex]->getH1()->getValue()
            .' - strana '
            . ($<?php echo $grid->getName(); ?>_limit ? ($<?php echo $grid->getName(); ?>_limit/$<?php echo $grid->getName(); ?>_per_page +1) : 1));
