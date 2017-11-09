[[

    

]]

<div class="datagridPopupHtml">

        <div class="model-form-holder">    
            
        <form id="<?php echo $formnew->getName() ?>" action="[[ echo App::getIns()->setActionLink('_curr','<?php echo $model->getHtmlID(); ?>-add') ]]" method="<?php echo $formnew->getMethod() ?>">                        
        
        <div class='error hidden'>Při ukládání došlo k chybám ve validaci, prosím opravte si svoje údaje.</div>    
                        
        <?php foreach($formnew->getModel()->getModel() as $key=>$child) { 
                if($child->isMixed()) printMixed ($child,$formnew);
                elseif($child->isPrimitive()&&$key!='ownerid'&&$key!='parentid'&&$key!='deleted'&&$key!='lastupdate'&&$key!='active'&&!$child instanceof Model_Primitive_Timestamp&&!$child->isPrimaryKey())

                    echo $child->getTemplate('form/new','template',$formnew);                             
               } ?>    
                                                            
            <div class="model-form-submit">
                <input type="submit" value="Uložit">
            </div>    
                        
        </form>    
                    
        </div>
        <br class="clear">
        
    
</div>    
    

