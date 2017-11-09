<?php

    

?>

<div class="datagridPopupHtml">

        <div class="model-form-holder">    
            
        <form id="newsformnew" action="<?php echo App::getIns()->setActionLink('_curr','news-add') ?>" method="post">                        
        
        <span class='error'></span>    
                  








<div class="model-form-row">
    <div class="model-form-collum-title">
        Název    </div>    
    <div class="model-form-collum-cell">   
        <input type="text" name="h1" value="">
    </div>            
</div>  


<div class="model-form-row">
    <div class="model-form-collum-title">
        Uri    </div>    
    <div class="model-form-collum-cell">   
        <input type="text" name="uri" value="">
    </div>            
</div>  
        



<div class="model-form-row">
    <div class="model-form-collum-title perex">
        Perex    </div>    
    <div class="model-form-collum-cell">   
        <textarea name="perex"></textarea>
    </div>            
</div>  



        




<div class="model-form-row">
    <div class="model-form-collum-title obsah">
        Obsah    </div>    
    <div class="model-form-collum-cell">        
        <textarea class="tinymce wys-obsah" name="content"></textarea>
    </div>            
</div>  


    

<div class="model-form-row">
    <div class="model-form-collum-title">
        Datum    </div>    
    <div class="model-form-collum-cell">
     <input type="text" class="idate-datum" name="date" value="<?php echo date('j.n.Y'); ?>">
    </div>            
</div>  
    
                                                            
            <div class="model-form-submit">
                <input type="submit" value="Uložit">
            </div>    
                        
        </form>    
                    
        </div>
        <br class="clear">
        
            
    
</div>    
    

