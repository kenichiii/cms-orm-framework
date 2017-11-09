

        <form id="<?php echo $formnew->getName() ?>" action="[[ echo App::getIns()->setActionLink('_curr','<?php echo $grid->getName(); ?>-add') ]]" method="<?php echo $formnew->getMethod() ?>">                        
        
        <div class='error hidden'>Při ukládání došlo k chybám ve validaci, prosím opravte si svoje údaje.</div>    
          
                <?php if($formnew->getModel()->isOwnerIdAble()) { ?><input value="" type="hidden" name='ownerid'><?php } ?>
                <?php if($formnew->getModel()->isParentIdAble()) { ?><input value="" type="hidden" name='parentid'><?php } ?>    
        
        
        <?php foreach($formnew->getModel()->getModel() as $ckey=>$cchild) { 
                if($cchild->isMixed()) printMixed ($cchild,$formnew);
                elseif($cchild->isPrimitive()&&$ckey!='deleted'&&$ckey!='ownerid'&&$ckey!='parentid'&&$ckey!='lastupdate'&&$ckey!='active'&&!$cchild instanceof Model_Primitive_Timestamp&&!$cchild->isPrimaryKey())
                    echo $cchild->getTemplate('form/new','template',$formnew);                             
               } ?>    
                           
                                    
            <br class="clear">
        
            <div class="model-form-submit">
                <input type="submit" value="Uložit">
            </div>    

         <br class="clear">
        
        </form>    
                    


          
    
 
    

