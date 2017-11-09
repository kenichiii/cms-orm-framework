

        
        <h1><?php echo $this->getTitle() ?></h1>

        <div class="model-form-holder">    
        <form id="<?php echo $this->getName() ?>" action="[[ echo App::getIns()->setActionLink('_curr','form-<?php echo $this->getModel()->getModelName(); ?>') ]]" method="<?php echo $this->getMethod() ?>">                        
        
        <div class='error hidden'>Při ukládání došlo k chybám ve validaci, prosím opravte si svoje údaje.</div>        
                        
        <?php foreach($this->getModel()->getModel() as $key=>$child) { 
                if($child->isMixed()) printMixed ($child,$this);
                elseif($child->isPrimitive()&&!$child->isPrimaryKey())
                {
                  if($key=='deleted'||$key=='active'||$key=='lastupdate'||$child instanceof Model_Primitive_Timestamp) continue;  
                  
                  echo $child->getTemplate('form/new','template',$this);                             
                }
               } ?>    
                                                            
            <div class="model-form-submit">
                <input type="submit" value="Uložit">
            </div>    
                        
        </form>    
        
            <div class="model-form-back">
                <button class="formBack">Zpět</button>
            </div>    
            
        </div>
        <br class="clear">
        
       