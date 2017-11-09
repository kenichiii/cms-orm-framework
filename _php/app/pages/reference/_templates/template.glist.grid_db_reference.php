
    <div class="grid_db_reference-holder">

     <?php if( $grid_db_reference_count > 0 ) { ?>

        <div class="grid_db_reference-list-line">        

        <?php foreach( $grid_db_reference_data as $rfkey => $rf ) { ?>

            <?php if( $rfkey%2 == 0 && $rfkey > 0 ){ ?>
            </div>  <!-- grid_db_reference-list-line  -->
            <div class="grid_db_reference-list-line">
            <?php } ?>

            <div class="grid_db_reference-item">

                <?php if( $rf->get('photo')->getValue()!='' ) { ?>
                <div class="grid_db_reference-item-photo-holder">
                    <div class="grid_db_reference-item-photo">
                        <a href="<?php echo App::getIns()->setLink('referencedetail') . $rf->get('uri')->getValue().'/'; ?>">
                           <img src="<?php echo Project::$WEB_URL . Magick_Factory::thumb('/'. $rf->get('photo')->getFullPath(),120,120); ?>" alt="<?php echo $rf->get('h1')->getValue(); ?>"> 
                        </a>    
                    </div>    
                    <div class="grid_db_reference-item-body">
                        <h2><a href="<?php echo App::getIns()->setLink('referencedetail') . $rf->get('uri')->getValue().'/'; ?>"><?php echo $rf->get('h1')->getValue(); ?></a></h2>
                                                <p><?php echo  $rf->get('perex')->getValue() ?></p>
                                                <a class="grid_db_reference-item-more-href" href="<?php echo App::getIns()->setLink('referencedetail') . $rf->getUri()->getValue().'/'; ?>">více</a>
                    </div>    
                </div>
                <?php } else { ?>
                              <div class="grid_db_reference-item-holder">

                        <h2><a href="<?php echo App::getIns()->setLink('referencedetail') . $rf->getUri()->getValue().'/'; ?>"><?php echo $rf->getH1()->getValue(); ?></a></h2>                        
                                                <p><?php echo  $rf->get('perex')->getValue() ?></p>

                        <a class="grid_db_reference-item-more-href" href="<?php echo App::getIns()->setLink('referencedetail') . $rf->getUri()->getValue().'/'; ?>">více</a>

                </div>

                <?php } ?>

           </div> <!-- grid_db_reference-item  -->

        <?php } //endforeach ?>        
        </div>  <!-- grid_db_reference-list-line  -->

        <?php if($grid_db_reference_count > $grid_db_reference_per_page)  { ?>
        <div class="grid_db_reference-paging-holder">
          <div class="pagingInner">  
            <?php echo $grid_db_reference_paging; ?>
          </div>   
        </div>   <!-- grid_db_reference-paging-holder  -->       
        <?php } ?>

     <?php } else { ?>

     Tato sekce je zatím prázdná.

     <?php } ?>

      </div>   <!-- grid_db_reference-holder  -->     

      <br class="clear">

      