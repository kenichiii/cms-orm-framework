<?php
 
    $id = $_GET['id'];
    
    if(is_numeric($id))
    {
        
        $bean  = HPBanner_Model::loadByPK($id);
                        
        if($bean instanceof HPBanner_Model) 
        {
        
            //
        
        }
        else $nenalezenoId = true;
    }
    else $nenalezenoId = true; 
?>

<div class="datagridPopupHtml">

 <?php if(isset($nenalezenoId)&&$nenalezenoId) { ?>
    
        <h1>Neplatné ID</h1>
        
        <?php } else { ?>

        
      <div style="float:right;padding-right:45px;padding-top: 10px">  
        <?php require '_templates/form.homebanner.foto.holder.php'; ?>        
      </div>  
        
        
      <div class="model-form-holder">
        <form id="homebannerformedit" action="<?php echo App::getIns()->setActionLink('_curr','hpbanners-edit') ?>" method="post">                        
        
        <span class='error'></span>    
        
                                <input type="hidden" name="id" value="<?php echo $bean->get('id')->getValue() ?>">
                                                                                                                                                    
        

<div class="model-form-row">

   
    <input <?php echo $bean->get('active')->getValue() > 0 ? 'checked="checked"' : '' ?> type="checkbox" id="chck-active" name="active" value="1">
   <label for="chck-active">  
    Aktivní    
   </label> 

</div>  



<div class="model-form-row">
    <div class="model-form-collum-title">
        Text    </div>    
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
      
    
</div> 