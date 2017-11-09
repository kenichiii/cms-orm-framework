


<h1><?php _et('Vítejte v administraci webu','section-admin'); ?></h1>
<br>
<div id="admin-home-links-list">
    <?php foreach (AppMenu::get(App::getIns()->currentPage()->getId()->getValue()) as $k=>$ritem) { ?>    
              <a href="<?php echo App::getIns()->setLink($ritem['page']->getPointer()->getValue()); ?>" title="<?php echo $ritem['page']->getH1()->getValue(); ?>">
               <span>   
                <?php echo $ritem['page']->getMenuName()->getValue(); ?>
               </span>    
              </a>    
    <?php } //endforeach ?>    
</div>
