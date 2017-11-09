<?php

  //get filters  
    $grid_db_news_limit = $_GET['limit'] = isset($_GET['limit'])?$_GET['limit']:0;
    $grid_db_news_per_page = $_GET['showPerPage'] = isset($_GET['showPerPage'])?$_GET['showPerPage']:6;            

  //create grid and assign filters
    $grid_db_news_grid = new News_Grid();
    $grid_db_news_data = $grid_db_news_grid    
                ->setDeletedCond()->setActiveCond()         
                ->orderBy( $grid_db_news_grid->getAlias('date') . ' DESC, '. $grid_db_news_grid->getAlias('id') .' DESC' )
           ->limit($grid_db_news_limit,$grid_db_news_per_page)         
         ;  

  //load data from grid  
    $grid_db_news_data = $grid_db_news_grid->getData();

  //get data count all   
    $grid_db_news_count = $grid_db_news_grid->getCount();

  //get grid data pagination  
                $grid_db_news_paging = paging($grid_db_news_count, array(
                    'limit_period' => $grid_db_news_per_page,
                    'paging_show'  => 9,
                    'limit' => $grid_db_news_limit,
                    'uri' => App::getIns()->setLink(App::getIns()->currentPage()->getPointer()->getValue()),
                    'params'=>''
                ));

  //set unique page title with paging  
    $pagetree = App::getIns()->getPageTree();
    $lastindex = count($pagetree)-1;
    App::getIns()->setPageTreePage($lastindex,'h1',
            $pagetree[$lastindex]->getH1()->getValue()
            .' - strana '
            . ($grid_db_news_limit ? ($grid_db_news_limit/$grid_db_news_per_page +1) : 1));
