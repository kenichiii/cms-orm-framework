
    <div class="grid_db_news-holder">

     <?php if( $grid_db_news_count > 0 ) { ?>

        <div class="grid_db_news-list-line">        

        <?php foreach( $grid_db_news_data as $nwkey => $nw ) { ?>


            <div class="grid_db_news-item">

                <?php if( $nw->get('photo')->getValue()!='' ) { ?>
                <div class="grid_db_news-item-photo-holder">
                    <div class="grid_db_news-item-photo">
                        <a href="<?php echo App::getIns()->setLink('newsdetail') . $nw->get('uri')->getValue().'/'; ?>">
                           <img src="<?php echo Project::$WEB_URL . Magick_Factory::thumb('/'. $nw->get('photo')->getFullPath(),250,250); ?>" alt="<?php echo $nw->get('h1')->getValue(); ?>"> 
                        </a>    
                    </div>    
                    <div class="grid_db_news-item-body">
                        <div class="grid_db_news-item-date"><?php echo $nw->get('date')->getViewValue(); ?> &nbsp;&nbsp;&nbsp;| </div> <h2><a href="<?php echo App::getIns()->setLink('newsdetail') . $nw->get('uri')->getValue().'/'; ?>"><?php echo $nw->get('h1')->getValue(); ?></a></h2>
                                                
                                                <p><?php echo  $nw->get('perex')->getValue() ?></p>
                                                <a class="grid_db_news-item-more-href" href="<?php echo App::getIns()->setLink('newsdetail') . $nw->getUri()->getValue().'/'; ?>">více</a>
                    </div>    
                </div>
                <?php } else { ?>
                              <div class="grid_db_news-item-holder">

                        <div class="grid_db_news-item-date"><?php echo $nw->get('date')->getViewValue(); ?> &nbsp;&nbsp;&nbsp;| </div> <h2><a href="<?php echo App::getIns()->setLink('newsdetail') . $nw->getUri()->getValue().'/'; ?>"><?php echo $nw->getH1()->getValue(); ?></a></h2>                        

                                                <p><?php echo  $nw->get('perex')->getValue() ?></p>

                        <a class="grid_db_news-item-more-href" href="<?php echo App::getIns()->setLink('newsdetail') . $nw->getUri()->getValue().'/'; ?>">více</a>

                </div>

                <?php } ?>

           </div> <!-- grid_db_news-item  -->

        <?php } //endforeach ?>        
        </div>  <!-- grid_db_news-list-line  -->

        <?php if($grid_db_news_count > $grid_db_news_per_page)  { ?>
        <div class="grid_db_news-paging-holder">
          <div class="pagingInner">  
            <?php echo $grid_db_news_paging; ?>
          </div>    
        </div>   <!-- grid_db_news-paging-holder  -->       
        <?php } ?>

     <?php } else { ?>

     Tato sekce je zatím prázdná.

     <?php } ?>

      </div>   <!-- grid_db_news-holder  -->     

      <br class="clear">

      