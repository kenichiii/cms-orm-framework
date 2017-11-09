<?php
 
    $id = AppUser::getIns()->getId()->getValue();
    
?>

<div class="datagridPopupHtml">

        <div class="model-form-holder">    
            
        <form id="userformpwd" action="<?php echo App::getIns()->setActionLink('_curr','my-password') ?>" method="post">                        
        
        <span class='error'></span>    
                               

                                        <input type="hidden" name="id" value="<?php echo $id ?>">


<div class="model-form-row">
    <div class="model-form-collum-title">
        Heslo    </div>    
    <div class="model-form-collum-cell">
        <input type="password" name="pwd" value="">
    </div>            
</div>  

<div class="model-form-row">
    <div class="model-form-collum-title">
        Heslo znova
    </div>    
    <div class="model-form-collum-cell">
        <input type="password" name="pwd_again" value="">
    </div>            
</div>  






    
                                                            
            <div class="model-form-submit">
                <input type="submit" value="Uložit">
            </div>    
                        
        </form>    
                    
        </div>
        <br class="clear">
        
            
    
</div>    