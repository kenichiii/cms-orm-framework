
<?php if(isset($nenalezenoId)&&$nenalezenoId) { ?>

        <h1>Neplatné ID</h1>

        <?php } else { ?>

       <div style='float:right'> 
        <img src="<?php echo Project::$WEB_URL.Magick_Factory::thumb( '/'.$owner->getGallery()->getDir().'/'. $bean->getSrc()->getValue(), 250, 250); ?>" alt=''>
       </div>

        <h3>Úprava obrázku</h3>

      <div class="model-form-holder">
        <form id="galerieformedit" action="<?php echo App::getIns()->setActionLink('_curr','news-gallery-item-edit') ?>" method="post">                        

        <span class='error'></span>    

                                <input type="hidden" name="id" value="<?php echo $bean->get('id')->getValue() ?>">

                                <input type="hidden" name="ownerid" value="">

<div class="model-form-row">
    <div class="model-form-collum-title">
        Název    </div>    
    <div class="model-form-collum-cell">
        <input type="text" name="h1" value="<?php echo $bean->get('h1')->getValue() ?>">
    </div>            
</div>  

<!--div class="model-form-row">
    <div class="model-form-collum-title popis">
        Popis    </div>    
    <div class="model-form-collum-cell">
        <textarea name="content"><?php echo $bean->get('content')->getValue(); ?></textarea>
    </div>            
</div-->  

<div class="model-form-row">
    <div class="model-form-collum-title">
        Soubor    </div>    
    <div class="model-form-collum-cell">
        <?php echo Project::$WEB_URL ?>/<?php echo $owner->getGallery()->getDir().'/'.$bean->get('src')->getValue() ?>
    </div>            
</div>  

            <br>

            <div class="model-form-submit">
                <input type="submit" value="Uložit">
            </div>    

        </form>    

       </div>  
       <br class="clear">

       <br>    

      <?php } ?>  