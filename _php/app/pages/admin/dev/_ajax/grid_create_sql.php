<?php



    $_files = array();    

    $grid = new $_GET['grid']();
    
    if( $grid instanceof Model_Grid )
    {
        $code = "drop table if exists ".$grid->getTableRaw().';'."\n\n";
        $code.= $grid->createTable();

        $_file = new stdClass();
        $_file->name = $grid->getModel()->getGridClassName();
        $_file->lang = 'sql';
        $_file->code = $code;
        $_files []= $_file;

   
    foreach( $grid->getModel()->getModel() as $key=>$child )
    {
        
        if( $child->isModel() )            
        {
            $code = "drop table if exists ".$child->getGrid()->getTableRaw().';'."\n\n";
            $code.= $child->getGrid()->createTable();
            
            $_file = new stdClass();
            $_file->name = $child->getGridClassName();
            $_file->lang = 'sql';
            $_file->code = $code;                                        
            $_files []= $_file;                  
        }
    }            
    
    
    foreach( $grid->getModel()->getRels() as $key=>$child )
    {                               
            if($child->isNN())
            {
                $code = "drop table if exists ".$grid->getModel()->getNNGrid($child)->getTableRaw().';'."\n\n";                
                $code.= $grid->getModel()->getNNGrid($child)->createTable();
            }
            else//if($child instanceof Gallery_Model)
            {
                $code = "drop table if exists ".$child->getGrid()->getTableRaw().';'."\n\n";                
                $code.= $child->getGrid()->createTable();
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
    