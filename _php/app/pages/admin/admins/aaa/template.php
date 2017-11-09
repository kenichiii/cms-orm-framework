
        <h1>Nový</h1>

        <div class="model-form-holder">    
        <form id="polozkaformnew" action="<?php echo App::getIns()->setActionLink('_curr','form-item') ?>" method="post">                        

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
    <div class="model-form-collum-cell err-content">        
        <textarea name="content"></textarea>
    </div>            
</div>  

<div class="model-form-row row-vaha">
    <div class="model-form-collum-title">
        Váha    </div>    
    <div class="model-form-collum-cell">
        <input type="text" name="vaha" value="">
    </div>            
</div>  

<div class="model-form-row row-vek">
    <div class="model-form-collum-title">
        Věk    </div>    
    <div class="model-form-collum-cell">
        <input type="text" name="vek" value="">
    </div>            
</div>  

<div class="model-form-row row-miry">
    <div class="model-form-collum-title">
        Míry    </div>    
    <div class="model-form-collum-cell">   
        <input type="text" name="miry" value="">
    </div>            
</div>  

            <div class="model-form-submit">
                <input type="submit" value="Uložit">
            </div>    

        </form>    

            <div class="model-form-back">
                <button class="formBack">Zpět</button>
            </div>    

        </div>
        <br class="clear">

       