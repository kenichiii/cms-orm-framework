<?php
 
    $id = $_GET['id'];
            
    $model = HPBanner_Model::loadByPK($id);
    $mrank = $model->getRank()->getValue();
    
    $downneib = $model->getGrid()
            ->setDeletedCond()
            ->where('and '.$model->getGrid()->getAlias('rank').'<%i',$mrank)
            ->orderBy($model->getGrid()->getAlias('rank').' DESC ')
            ->limit(1)
            ->getSingle();

    if($downneib instanceof HPBanner_Model)
    {        
        $model->set('rank',$downneib->getRank()->getValue())->update();
        $downneib->set('rank',$mrank)->update();
        __c()->clean();
    }
    
    
    
    echo "done";