

<?php

$h1 = $model->isH1Able();
$photo = $model->isPhotoAble();
$date = $model->isDateAble();
$perex = $model->isPerexAble();
$content = $model->isContentAble();
$gallery = $model->isGalleryAble();

?>

    

    [[ if(isset($notfound)&&$notfound) { ]]    
        
    Vámi požadovaná stránka neexistuje nebo byla stažena.
        
    [[ } else { ]]    
        
    <div class="<?php echo $model->getModelName(); ?>-holder<?php if( $photo ) { ?>[[ if( $bean->get<?php echo $photo->getCollum(); ?>()->getValue()!='' ) { ]] hasPhoto[[ } ]]<?php } ?>">
    
    <?php if( $photo ) { ?>    
      [[ if( $bean->get<?php echo $photo->getCollum(); ?>()->getValue()!='' ) { ]]
        <div class="<?php echo $model->getModelName(); ?>-foto-holder">
           <a class="<?php echo $model->getModelName(); ?>-foto-big" href="[[ echo Project::$WEB_URL . Magick_Factory::thumb('/'. $bean->get<?php echo $photo->getCollum(); ?>()->getFullPath(),800,600); ]]" title="[[ echo $bean->get('<?php echo $h1->getCollum(); ?>')->getValue(); ]]"> 
             <img src="[[ echo Project::$WEB_URL . Magick_Factory::thumb('/'. $bean->get<?php echo $photo->getCollum(); ?>()->getFullPath(),460,400); ]]" alt="[[ echo $bean->getH1()->getValue(); ]]"> 
           </a>  
        </div> <!-- <?php echo $model->getModelName(); ?>-foto-holder -->   
      [[ } ]]
    <?php } ?>    
        
        
        <?php 

                                       if($date)
                                        {
                                            ?>
                        
                     <div class="<?php echo $model->getModelName(); ?>-collum-date mod-coll-<?php echo $date->getCollum(); ?>">
                        <div class="<?php echo $model->getModelName(); ?>-collum-title"><strong><?php echo $date->getTitle(); ?>:</strong></div>
                        <div class="<?php echo $model->getModelName(); ?>-collum-value">[[ echo $bean->get('<?php echo $date->getCollum(); ?>')->getViewValue(); ]]</div>
                    </div>      
             <?php
            }        
        
            if($perex)
            {
                ?>
      
                    <p class="<?php echo $model->getModelName(); ?>-collum-perex coll-<?php echo $perex->getCollum(); ?>">
                        <strong>[[ echo $bean->get('<?php echo $perex->getCollum(); ?>')->getViewValue(); ]]</strong>
                    </p>      
                <?php
            }

            if($content)
            {
                ?>
      
                    <div class="<?php echo $model->getModelName(); ?>-collum-content coll-<?php echo $content->getCollum(); ?>">
                        [[ echo $bean->get('<?php echo $content->getCollum(); ?>')->getViewValue(); ]]
                    </div> <!-- end model content <?php echo $content->getCollum(); ?> -->     
                <?php
            }
                    
        
      ?>
      
      <div class="<?php echo $model->getModelName(); ?>-collums">
          
      <?php
            foreach( $model->getModel() as $key => $child ) {
               
                if($child->isDefault()) continue;
                
                if($child->isMixed()) printModelViewMixed ($model,$child);
                elseif($child->isPrimitive())
                {
                    ?>
          
                        <div class="<?php echo $model->getModelName(); ?>-collum coll-<?php echo $child->getCollum(); ?>">
                            <div class="<?php echo $model->getModelName(); ?>-collum-title "><strong><?php echo $child->getTitle(); ?>:</strong></div>
                            <div class="<?php echo $model->getModelName(); ?>-collum-value">[[ echo $bean->get('<?php echo $child->getCollum(); ?>')->getViewValue(); ]]</div>
                        </div>
                    <?php
                }
                elseif($child->isModel())
                {
                    ?>
          
                    <div class="<?php echo $model->getModelName(); ?>-<?php echo ($child->getModelName()) ?>-model mod-<?php echo ($child->getModelName()) ?>">
                        <div class="<?php echo $model->getModelName(); ?>-<?php echo ($child->getModelName()) ?>-model-title">
                            <h2><?php echo $ch1 = $child->isH1Able() ? $ch1->getViewValue() : ($child->getModelTitle()) ?></h2>
                         </div>      
                        
                            <?php             

                                       if($chdate = $child->isDateAble())
                                        {
                                            ?>
                        
                                  <div class="<?php echo $child->getModelName(); ?>-collum-date mod-coll-<?php echo $chdate->getCollum(); ?>">
                                      <div class="<?php echo $child->getModelName(); ?>-collum-title"><strong><?php echo $chdate->getTitle(); ?>:</strong></div>
                                      <div class="<?php echo $child->getModelName(); ?>-collum-value">[[ echo $bean->get('<?php echo $date->getCollum(); ?>')->getViewValue(); ]]</div>
                                  </div>      
                                            <?php
                                        }
                                        
                                        if($chperex = $child->isPerexAble())
                                        {
                                            ?>
                        
                                  <p class="<?php echo $child->getModelName(); ?>-collum-perex mod-coll-<?php echo $chperex->getCollum(); ?>">
                                      <strong>[[ echo $bean->get('<?php echo $chperex->getCollum(); ?>')->getViewValue(); ]]</strong>
                                  </p>      
                                            <?php
                                        }

                                        if($chcontent = $child->isContentAble())
                                        {
                                            ?>
                                  
                                  <div class="<?php echo $child->getModelName(); ?>-collum-content mod-coll-<?php echo $chcontent->getCollum(); ?>">
                                      [[ echo $bean->get('<?php echo $chcontent->getCollum(); ?>')->getViewValue(); ]]
                                  </div> <!-- end model content <?php echo $chcontent->getCollum(); ?> -->     
                                            <?php
                                        }
                                  ?>
    
                        
                    <?php 
        
                     foreach( $child->getModel() as $ckey => $schild ) {

                         if($schild->isDefault()) continue;
                         
                            if($schild->isMixed()) printModelViewMixed ($child,$schild);
                            elseif($schild->isPrimitive())
                            {
                    ?>
                                  
                                    <div class="<?php echo $child->getModelName(); ?>-collum mod-coll-<?php echo $schild->getCollum(); ?>">
                                        <div class="<?php echo $child->getModelName(); ?>-collum-title"><strong><?php echo $schild->getTitle(); ?>:</strong></div>
                                        <div class="<?php echo $child->getModelName(); ?>-collum-value">[[ echo $bean->get('<?php echo $schild->getCollum(); ?>')->getViewValue(); ]]</div>
                                    </div> <!-- <?php echo $child->getModelName(); ?>-collum <?php echo $schild->getCollum(); ?> -->
                        
                    <?php
                            }


                        }
                    ?>
                                  
                     </div> <!-- <?php echo $model->getModelName(); ?>-<?php echo ($child->getModelName()) ?>-model mod-<?php echo ($child->getModelName()) ?> -->      
                    <?php                        
                } //end if model
                
                
            } //endforeach 
            
           ?> 
          
        </div> <!-- <?php echo $model->getModelName(); ?>-collums --> 
                        
      </div> <!-- <?php echo $model->getModelName(); ?>-holder -->
      
      <br class="clear">
                        
      <?php if($gallery) { ?>
      <div class="model-gallery">
      [[ require '_templates/<?php echo $model->getModelName(); ?>-gallery.php'; ]]
      </div> <!-- model-gallery -->
      <?php } ?>
      
      [[ } //end else notfound ]]
      
      
      
      
 <?php 
            function printModelViewMixed($model,$child) {              
                 ?>
      
                <div class="<?php echo $model->getModelName(); ?>-mixed mix-<?php echo ($child->getModelName()) ?>">
                        <div class="<?php echo $model->getModelName(); ?>-mixed-title">
                              <h3><?php echo ($child->getModelTitle()) ?></h3>
                        </div>
                        
                    <?php 
                    foreach($child->getModel() as $key=>$mchild) 
                        {                                             
                          if($mchild->isMixed())  printModelViewMixed($model,$mchild); 
                          elseif($mchild->isPrimitive())
                              ?>
                    
                            <div class="<?php echo $model->getModelName(); ?>-collum coll-<?php echo $mchild->getCollum(); ?>">
                                <div class="<?php echo $model->getModelName(); ?>-collum-title "><strong><?php echo $mchild->getTitle(); ?>:</strong></div>
                                <div class="<?php echo $model->getModelName(); ?>-collum-value">[[ echo $bean->get('<?php echo $mchild->getCollum(); ?>')->getViewValue(); ]]</div>
                            </div> <!-- <?php echo $model->getModelName(); ?>-collum <?php echo $mchild->getCollum(); ?> -->
                        
                             <?php
                        }
                                                                                                
                   ?> 
                    
                 </div> <!-- <?php echo $model->getModelName(); ?>-mixed mix-<?php echo ($child->getModelName()) ?> -->

 <?php                                     
            }                        
 ?>
