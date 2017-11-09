[[
    
   $id = $_GET['id'];

    if(is_numeric($id))
    {
<?php if($modelModelClass) { ?>
    
        $bean  = <?php echo $modelModelClass ?>::loadByPK($id);
                        
        if($bean instanceof <?php echo $modelModelClass ?>) 
        {
        
            //
        
        }
        else $notFoundedId = true;
        
<?php } ?>        
    }
    else $notFoundedId = true;
    
]]


        [[ if(isset($notFoundedId)&&$notFoundedId) { ]]
    
        <h1>Neplatné ID</h1>
        
        [[ } else { ]]

<?php if($modelModelClass) { ?>        
      <div class="model-form-holder">
        <form id="<?php echo $model->getHtmlID() ?>-form-<?php echo $action ?>" action="[[ echo App::getIns()->setActionLink('_curr','<?php echo $model->getHtmlID(); ?>-<?php echo $action ?>') ]]" method="post">                        
        
        <div class='error hidden'>Při ukládání došlo k chybám ve validaci, prosím opravte si svoje údaje.</div>    
        
        <?php foreach($modelModel->getModel() as $key=>$child) { ?>
            <?php if($child->isPrimitive()&&$child->isPrimaryKey()) { ?>
            <input type="hidden" name="<?php echo $child->getCollum() ?>" value="[[ echo $bean->get('<?php echo $child->getCollum() ?>')->getValue() ]]">
            <?php } ?>
        <?php } ?>

            
            
            
            <div class="model-form-submit">
                <input type="submit" value="Uložit">
            </div>    
                        
        </form>    
        
       </div>  
       <br class="clear">
        
<?php
         }
?>    
         
      [[ } ]]      
