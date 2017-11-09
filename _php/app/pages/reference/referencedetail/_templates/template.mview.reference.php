
    <?php if(isset($notfound)&&$notfound) { ?>    

    Vámi požadovaná stránka neexistuje nebo byla stažena.

    <?php } else { ?>    

    <div class="reference-holder <?php if( $bean->getphoto()->getValue()!='' ) { ?>hasPhoto<?php } ?>">


                    <?php if($bean->get('datum')->getValue()) { ?>
                        <div class="reference-collum coll-datum">
                            <div class="reference-collum-title "><strong>Datum:</strong></div>
                            <div class="reference-collum-value"><?php echo $bean->get('datum')->getViewValue(); ?></div>
                        </div>
                    <?php } ?>
                
        
                    <p class="reference-collum-perex coll-perex">
                        <strong><?php echo $bean->get('perex')->getViewValue(); ?></strong>
                    </p>      

                    <div class="reference-collum-content coll-content">
                        <?php echo $bean->get('content')->getViewValue(); ?>
                    </div> <!-- end model content content -->     

      <?php if( $bean->getphoto()->getValue()!='' ) { ?>
        <div class="reference-foto-holder">
           <a class="reference-foto-big" href="<?php echo Project::$WEB_URL . Magick_Factory::thumb('/'. $bean->getphoto()->getFullPath(),800,600); ?>" title="<?php echo $bean->getH1()->getValue(); ?>"> 
             <img src="<?php echo Project::$WEB_URL . Magick_Factory::thumb('/'. $bean->getphoto()->getFullPath(),460,400); ?>" alt="<?php echo $bean->getH1()->getValue(); ?>"> 
           </a>  
        </div> <!-- reference-foto-holder -->   
      <?php } ?>                    
                    

      </div> <!-- reference-holder -->

      <br class="clear">

      <div class="model-gallery">
          <?php require '_templates/reference-gallery.php';?>
      </div> <!-- model-gallery -->    
      
      <?php } //end else notfound ?>

 