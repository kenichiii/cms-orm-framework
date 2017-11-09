[[
    
    $id = App::getIns()->getParam( App::getIns()->currentPage()->getUri()->getValue() );

    if(is_numeric($id))
    {
        
        $bean  = <?php echo $this->getModelClass() ?>::loadByPK($id);
                        
        if($bean instanceof <?php echo $this->getModelClass() ?>) 
        {
        
            //
        
        }
        else $nenalezenoId = true;
    }
    else $nenalezenoId = true;
    

