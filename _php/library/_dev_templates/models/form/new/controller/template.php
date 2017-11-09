[[
  



       <?php 
               foreach($this->getModel()->getModel() as $key=>$child) { 
                if($child->isMixed()) printMixedC ($child);
                elseif($child->isPrimitive()&&!$child->isInnerSql()&&!$child->isPrimaryKey())
                    echo $child->getTemplate('form/new','controller');                             
               } 
               ?> 

       <?php 
       
       function printMixedC($child) { 
             if($child->isMixed()) { 
                    foreach($child->getModel() as $key2=>$mchild) 
                        {                                             
                          if($mchild->isMixed())  printMixedJquery($mchild); 
                          elseif($mchild->isPrimitive()&&!$mchild->isInnerSql()&&!$mchild->isPrimaryKey())
                            echo $child->getTemplate('form/new','controller');  
                        }
                                                                                                
                   ?> </div> <?php      
            } elseif($child->isPrimitive()&&!$child->isInnerSql()&&!$child->isPrimaryKey())
              echo $child->getTemplate('form/new','controller');                             
                   
        }
        
        ?>    

