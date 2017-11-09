<?php



    $_files = array();    

    $grid = new $_GET['grid']();
    
    if( $grid instanceof Model_Grid )
    {
        
        $code = $grid->alterTable(Project::$databaseConfig['database']);

        $_file = new stdClass();
        $_file->name = $grid->getModel()->getGridClassName();
        $_file->lang = 'sql';
        $_file->code = $code;
        $_files []= $_file;


    foreach( $grid->getModel()->getModel() as $key=>$child )
    {
        
        if( $child->isModel() )            
        {
          
          if($child->getModelName() == trim($_GET['child']))
          {    
            $code.= $child->getGrid()->alterTable(Project::$databaseConfig['database']);
            
            $_file = new stdClass();
            $_file->name = $child->getGridClassName();
            $_file->lang = 'sql';
            $_file->code = $code;                                        
            $_files []= $_file;        
          }
        }
    }            
    
    
    foreach( $grid->getModel()->getRels() as $key=>$child )
    {
                 
              
            if($child->isNN())
            {
                $code = $grid->getModel()->getNNGrid($child)->alterTable(Project::$databaseConfig['database']);
            }
            else//if($child instanceof Gallery_Model)
            {
                $code = $child->getGrid()->alterTable(Project::$databaseConfig['database']);
            }
            
            $_cfile = new stdClass();
            $_cfile->name = $child->isNN()?'::NNGRID_'.$child->getModelName().'_'.$grid->getModel()->getGridClassName():$child->getGridClassName();
            $_cfile->lang = 'sql';
            $_cfile->code = $code;                                        
            $_files []= $_cfile;        
          
     }
            
    
    
    
    }
    else {
            $_file = new stdClass();
            $_file->name = 'ERROR';
            $_file->code = 'NEPLATNY GRID '.$grid;                                        
            $_files []= $_file;        
    }
    
    echo json_encode(array('generator'=>'grid_sql','files'=>$_files));
    