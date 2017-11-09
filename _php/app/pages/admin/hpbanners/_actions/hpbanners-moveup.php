<?php
 
    $id = $_GET['id'];
            
    $model = HPBanner_Model::loadByPK($id);
    $mrank = $model->getRank()->getValue();
    
    $upneib = $model->getGrid()
            ->setDeletedCond()
            ->where('and '.$model->getGrid()->getAlias('rank').'>%i',$mrank)
            ->orderBy($model->getGrid()->getAlias('rank').' ASC ')
            ->limit(1)
            ->getSingle();
    
    //echo dibi::$sql;
    
    if($upneib instanceof HPBanner_Model)
    {        
        $model->set('rank',$upneib->getRank()->getValue())->update();
        $upneib->set('rank',$mrank)->update();
        __c()->clean();
    }
    
    
    
    echo "done";