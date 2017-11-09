


    <div class="katalog-rozcestnik">
    <?php foreach (AppMenu::get(App::getIns()->currentPage()->getId()->getValue()) as $k=>$ritem) { ?>    
      <div class="katalog-rozcestnik-item">  
          <div class="katalog-rozcestnik-item-title">  
              <a href="<?php echo App::getIns()->setLink($ritem['page']->getPointer()->getValue()); ?>" title="<?php echo $ritem['page']->getH1()->getValue(); ?>">  
                <?php echo $ritem['page']->getH1()->getValue(); ?>
              </a>    
          </div>    
          <div class="katalog-rozcestnik-item-icon">
              <a href="<?php echo App::getIns()->setLink($ritem['page']->getPointer()->getValue()); ?>" title="<?php echo $ritem['page']->getH1()->getValue(); ?>">                
                 <img src="<?php echo '/'.$ritem['page']->getPhoto()->getDir().'/'.$ritem['page']->getPhoto()->getValue(); ?>" alt="<?php echo $ritem['page']->getH1()->getValue(); ?>">          
              </a>   
          </div>
      </div>  
    <?php } //endforeach ?>    
    </div>

    <br class="clear"><br><br>