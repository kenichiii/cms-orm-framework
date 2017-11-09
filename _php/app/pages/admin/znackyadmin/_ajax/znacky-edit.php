<?php
    
   $id = $_GET['id'];

    if(is_numeric($id))
    {
        
        $bean  = Znacky_Model::loadByPK($id);
                        
        if($bean instanceof Znacky_Model) 
        {
        
            //
        
        }
        else $notFoundedId = true;
    }
    else $notFoundedId = true;
    
?>


        <?php if(isset($notFoundedId)&&$notFoundedId) { ?>
    
        <h1>Neplatné ID</h1>
        
        <?php } else { ?>

        
        <div style="float:right;padding-right: 15px;padding-bottom: 5px;">
        
            <?php require '_templates/form.znacky.foto.holder.php';?>
        </div>    
        
      <div class="model-form-holder">
        <form id="znackyformedit" action="<?php echo App::getIns()->setActionLink('_curr','znacky-edit') ?>" method="post">                        
        
        <span class='error'></span>    
        
                                <input type="hidden" name="id" value="<?php echo $bean->get('id')->getValue() ?>">
                                                                                                                                
       

<div class="model-form-row">

   <label for="active"> 
    <input <?php echo $bean->get('active')->getValue() > 0 ? 'checked="checked"' : '' ?> type="checkbox" id="active" name="active" value="1">
    Aktivní    
   </label> 

</div>  



<div class="model-form-row">
    <div class="model-form-collum-title">
        Název    </div>    
    <div class="model-form-collum-cell">
        <input type="text" name="h1" value="<?php echo $bean->get('h1')->getValue() ?>">
    </div>            
</div>  

        


<div class="model-form-row">
    <div class="model-form-collum-title">
        Odkaz    </div>    
    <div class="model-form-collum-cell">
        <input type="text" name="link" value="<?php echo $bean->get('link')->getValue() ?>">
    </div>            
</div>  

            
                                     
            
            <div class="model-form-submit">
                <input type="submit" value="Uložit">
            </div>    
                        
        </form>    
        
       </div>  
       <br class="clear">
        
           
         
      <?php } ?>      
