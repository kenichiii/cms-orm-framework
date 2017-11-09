
<?php

$photo = $grid->getModel()->isPhotoAble();
$h1 = $grid->getModel()->isH1Able();
$uri = $grid->getModel()->isUriAble();
$date = $grid->getModel()->isDateAble();
$perex = $grid->getModel()->isPerexAble();
$content = $grid->getModel()->isContentAble();

?>


    <div class="<?php echo $grid->getName(); ?>-holder">
        
     [[ if( $<?php echo $grid->getName(); ?>_count > 0 ) { ]]
          
        <div class="<?php echo $grid->getName(); ?>-list-line">        
     
            
        [[ foreach( $<?php echo $grid->getName();  ?>_data as $key => $<?php echo $grid->getModel()->getModelName();  ?> ) { ]]
        
            [[ if( $key%2 == 0 && $key > 0 ){ ]]
            </div>  <!-- <?php echo $grid->getName(); ?>-list-line  -->
            <div class="<?php echo $grid->getName(); ?>-list-line">
            [[ } ]]
                        
            <div class="<?php echo $grid->getName(); ?>-item">
              <?php if($photo) { ?>  
                [[ if( $<?php echo $grid->getModel()->getModelName();  ?>->get('<?php echo $photo->getCollum(); ?>')->getValue()!='' ) { ]]
                <div class="<?php echo $grid->getName(); ?>-item-photo-holder">
                    <div class="<?php echo $grid->getName(); ?>-item-photo">
                        <a href="[[ echo App::getIns()->setLink('<?php echo $detailpointer; ?>') . $<?php echo $grid->getModel()->getModelName();  ?>->get('<?php echo $uri->getCollum() ?>')->getViewValue().'/'; ]]">
                           <img src="[[ echo Project::$WEB_URL . Magick_Factory::thumb('/'. $<?php echo $grid->getModel()->getModelName();  ?>->get('<?php echo $photo->getCollum(); ?>')->getFullPath(),120,120); ]]" alt="[[ echo strip_tags($<?php echo $grid->getModel()->getModelName();  ?>->get('<?php echo $h1->getCollum(); ?>')->getViewValue()); ]]"> 
                        </a>    
                    </div>    
                    <div class="<?php echo $grid->getName(); ?>-item-body">
                        <h2><a href="[[ echo App::getIns()->setLink('<?php echo $detailpointer; ?>') . $<?php echo $grid->getModel()->getModelName();  ?>->get('<?php echo $uri->getCollum(); ?>')->getValue().'/'; ]]">[[ echo $<?php echo $grid->getModel()->getModelName();  ?>->get('<?php echo $h1->getCollum(); ?>')->getViewValue(); ]]</a></h2>
                        
                        <?php if($date) { ?><div class="date">[[ echo  $<?php echo $grid->getModel()->getModelName();  ?>->get('<?php echo $date->getCollum(); ?>')->getViewValue() ]]</div><?php } ?>
                        
                        <?php if($perex) { ?>
                        <p>[[ echo  $<?php echo $grid->getModel()->getModelName();  ?>->get('<?php echo $perex->getCollum(); ?>')->getViewValue() ]]</p>
                        <?php } elseif($content) { ?>
                        <p>[[ echo  perex($<?php echo $grid->getModel()->getModelName();  ?>->get('<?php echo $content->getCollum(); ?>')->getViewValue()) ]]</p>
                        <?php } ?>
                        
                        <a class="<?php echo $grid->getName(); ?>-item-more-href" href="[[ echo App::getIns()->setLink('<?php echo $detailpointer; ?>') . $<?php echo $grid->getModel()->getModelName();  ?>->getUri()->getViewValue().'/'; ]]">více &Gt;</a>
                    </div>    
                </div>
                [[ } else { ]]
              <?php } //is photoable ?>
                <div class="<?php echo $grid->getName(); ?>-item-holder">
                        <h2><a href="[[ echo App::getIns()->setLink('<?php echo $detailpointer; ?>') . $<?php echo $grid->getModel()->getModelName();  ?>->get('<?php echo $uri->getCollum(); ?>')->getValue().'/'; ]]">[[ echo $<?php echo $grid->getModel()->getModelName();  ?>->get('<?php echo $h1->getCollum(); ?>')->getViewValue(); ]]</a></h2>
                        
                        <?php if($date) { ?><div class="date">[[ echo $<?php echo $grid->getModel()->getModelName();  ?>->get('<?php echo $date->getCollum(); ?>')->getViewValue() ]]</div><?php } ?>
                        
                        <?php if($perex) { ?>
                        <p>[[ echo  $<?php echo $grid->getModel()->getModelName();  ?>->get('<?php echo $perex->getCollum(); ?>')->getViewValue() ]]</p>
                        <?php } elseif($content) { ?>
                        <p>[[ echo  perex($<?php echo $grid->getModel()->getModelName();  ?>->get('<?php echo $content->getCollum(); ?>')->getViewValue()) ]]</p>
                        <?php } ?>
                        
                        <a class="<?php echo $grid->getName(); ?>-item-more-href" href="[[ echo App::getIns()->setLink('<?php echo $detailpointer; ?>') . $<?php echo $grid->getModel()->getModelName();  ?>->getUri()->getViewValue().'/'; ]]">více &Gt;</a>

                </div>
              <?php if($photo) { ?>  
                [[ } ]]
              <?php } ?>  
           </div> <!-- <?php echo $grid->getName(); ?>-item  -->
        
        [[ } //endforeach ]]        
        </div>  <!-- <?php echo $grid->getName(); ?>-list-line  -->
        
        [[ if($<?php echo $grid->getName(); ?>_count > $<?php echo $grid->getName(); ?>_per_page)  { ]]
        <div class="<?php echo $grid->getName(); ?>-paging-holder">
            [[ echo $<?php echo $grid->getName(); ?>_paging; ]]
        </div>   <!-- <?php echo $grid->getName(); ?>-paging-holder  -->       
        [[ } ]]
     
     [[ } else { ]]
     
     Tato sekce je zatím prázdná.
     
     [[ } ]]
     
      </div>   <!-- <?php echo $grid->getName(); ?>-holder  -->     

      <br class="clear">
      
      