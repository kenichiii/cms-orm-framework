


    <div class="grid_news-holder">
        
        
        <div class="grid_news-list">        
        <?php foreach( $grid_news as $key => $nw ) { ?>

            <div class="grid_news-item">
                                <div class="grid_news-item-holder">

                        <h2><a href="<?php echo App::getIns()->setLink('newsdetail') . $nw->getUri().'/'; ?>"><?php echo $nw->getH1()->getValue(); ?></a></h2>
                        
                        
                        <a class="grid_news-item-more-href" href="<?php echo App::getIns()->setLink('newsdetail') . $nw->getUri().'/'; ?>">více ≫</a>

                </div>
                
           </div>
        
        <?php } //endforeach ?>        
        </div>
        
        <?php if($grid_newscount>$grid_newsper_page)  { ?>
        <div class="grid_news-paging-holder">
            <?php echo $grid_newspaging; ?>
        </div>        
        <?php } ?>
        
        
      </div>      

