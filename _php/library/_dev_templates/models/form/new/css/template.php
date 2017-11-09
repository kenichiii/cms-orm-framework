



               <?php 
               foreach($this->getModel()->getModel() as $key=>$child) { 
                if($child->isMixed()) printMixedCss ($child);
                elseif($child->isPrimitive()&&!$child->isInnerSql()&&!$child->isPrimaryKey())
                    echo $child->getTemplate('form/new','css');                             
               } 
               ?> 

       <?php 
       
       function printMixedCss($child) { 
             if($child->isMixed()) { 
                    foreach($child->getModel() as $key2=>$mchild) 
                        {                                             
                          if($mchild->isMixed())  printMixedJquery($mchild); 
                          elseif($mchild->isPrimitive()&&!$mchild->isInnerSql()&&!$mchild->isPrimaryKey())
                            echo $mchild->getTemplate('form/new','css');  
                        }
                                                                                                
                   ?> </div> <?php      
            } elseif($child->isPrimitive()&&!$child->isInnerSql()&&!$child->isPrimaryKey())
              echo $child->getTemplate('form/new','css');                             
                   
        }
        
        ?>