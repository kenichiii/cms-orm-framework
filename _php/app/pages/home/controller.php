<?php
          

  //create grid and assign filters
    $grid_hpznacky_grid = new HPZnacky_Grid();
    $grid_hpznacky_grid    
                ->setDeletedCond()->setActiveCond()                
                ->setRankOrderByCond()                    
         ;  

  //load data from grid  
    $grid_hpznacky_data = $grid_hpznacky_grid->getData();

 