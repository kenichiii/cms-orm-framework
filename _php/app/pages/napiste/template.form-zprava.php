
        
        <div class="model-form-holder">    
        <form id="zpravaformnew" action="<?php echo App::getIns()->setActionLink('_curr','form-zprava') ?>" method="post">                        
        
        <div class='error hidden'>Při ukládání došlo k chybám ve validaci, prosím opravte si svoje údaje.</div>    
             








<div class="model-form-row">
    <div class="model-form-collum-title">
        Jméno    </div>    
    <div class="model-form-collum-cell">   
        <input type="text" name="jmeno" value="">
    </div>            
</div>  


        


<div class="model-form-row">
    <div class="model-form-collum-title">
        Email    </div>    
    <div class="model-form-collum-cell">   
        <input type="text" name="email" value="">
    </div>            
</div>  


        


<div class="model-form-row">
    <div class="model-form-collum-title">
        Telefon    </div>    
    <div class="model-form-collum-cell">   
        <input type="text" name="telefon" value="">
    </div>            
</div>  


        


<div class="model-form-row">
    <div class="model-form-collum-title zprava">
        Zpráva    </div>    
    <div class="model-form-collum-cell"> 
        <textarea id="zprava" name="zprava"><?php echo $zprava; ?></textarea>
    </div>            
</div>  
<br class="clear">
    
                                                            
            <div class="model-form-submit">
                <input type="submit" value="Odeslat">
            </div>    
                        
        </form>    
         
            
        </div>
        <br class="clear">
        
                   