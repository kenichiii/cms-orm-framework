<?php

?>

<div class="datagridPopupHtml">

        <div class="model-form-holder">    

        <form id="referenceformnew" action="<?php echo App::getIns()->setActionLink('_curr','refs-add') ?>" method="post">                        

        <div class='error hidden'>Při ukládání došlo k chybám ve validaci, prosím opravte si svoje údaje.</div>    

<div class="model-form-row row-h1">
    <div class="model-form-collum-title">
        Nadpis    </div>    
    <div class="model-form-collum-cell">   
        <input type="text" name="h1" value="">
    </div>            
</div>  

<div class="model-form-row row-uri">
    <div class="model-form-collum-title">
        Uri    </div>    
    <div class="model-form-collum-cell">   
        <input type="text" name="uri" value="">
    </div>            
</div> 

<div class="model-form-row row-perex">
    <div class="model-form-collum-title perex">
        Perex    </div>    
    <div class="model-form-collum-cell">   
        <textarea name="perex"></textarea>
    </div>            
</div>  

<div class="model-form-row row-content">
    <div class="model-form-collum-title content">
        Obsah    </div>    
    <div class="model-form-collum-cell">        
        <textarea name="content"></textarea>
    </div>            
</div>  

<div class="model-form-row row-datum">
    <div class="model-form-collum-title">
        Datum    </div>    
    <div class="model-form-collum-cell">   
        <input type="text" name="datum" value="">
    </div>            
</div>  

            <div class="model-form-submit">
                <input type="submit" value="Uložit">
            </div>    

        </form>    

        </div>
        <br class="clear">

</div>    

