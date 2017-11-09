


    

    <?php if(isset($notfound)&&$notfound) { ?>    
        
    Vámi požadovaná stránka neexistuje nebo byla stažena.
        
    <?php } else { ?>    
        
    <div class="news-holder <?php if( $bean->get('photo')->getValue()!='' ) { ?>hasFoto<?php } ?>">
    
        
      <?php if( $bean->get('photo')->getValue()!='' ) { ?>
        <div class="news-foto-holder">
           <a class="news-foto-big" href="<?php echo Project::$WEB_URL . Magick_Factory::thumb('/'. $bean->get('photo')->getFullPath(),800,600); ?>" title="<?php echo $bean->get('h1')->getValue(); ?>"> 
               <img src="<?php echo Project::$WEB_URL . Magick_Factory::thumb('/'. $bean->getPhoto()->getFullPath(),460,400); ?>" alt="<?php echo $bean->get('h1')->getValue(); ?>"> 
           </a>  
        </div>    
      <?php } ?>
        
      <div class="news-collum news-collum-datum">
          <div class="news-collum-title "><strong>Datum:</strong></div>
          <div class="news-collum-value"><?php echo $bean->get('date')->getViewValue(); ?></div>
      </div>  
        
      <p class="news-collum-perex">
          <strong>  
            <?php echo $bean->get('perex')->getViewValue(); ?>
          </strong>    
      </p>
      
      <div class="news-collum-content">
        <?php echo $bean->get('content')->getViewValue(); ?>
      </div>    
      
      
      <br class='clear'>
      <br>
      <?php require '_templates/news-gallery.php'; ?>
      
      </div>
      
      <br class="clear">
                        
      
      <?php } //end else notfound ?>
      
      
      
      
 