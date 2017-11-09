
<div id="znacky-holder">        
<?php foreach ($znacky as $key => $z) { ?>
    <div class="fleft znacka">
        <div>
        <?php if( $z->getLink()->getValue() ): ?><a title="<?php echo $z->getH1()->getValue(); ?>" href="<?php echo substr($z->getLink()->getValue(),0,3)=='www'? 'http://'.$z->getLink()->getValue():$z->getLink()->getValue(); ?>" class="blank znacka-link"><?php endif; ?>
            <img src="/<?php echo $z->getPhoto()->getDir() . '/' . $z->getPhoto()->getValue(); ?>" alt="<?php echo $z->getH1()->getValue(); ?>">
        <?php if( $z->getLink()->getValue() ): ?></a><?php endif; ?>
        </div>    
        <?php 
            
            $wanted = parse_seo_title($z->getH1()->getValue());
            
            $pagesGrid = new Page_Grid();
            $galleries = $pagesGrid->setActiveCond()->setDeletedCond()
                    ->andWhere( $pagesGrid->getAlias('pointer')." like %s", $wanted.'%' )
                    ->setRankOrderByCond('DESC')
                ->getData();  
            //echo $wanted;
            
            foreach($galleries as $galpage) { 
          
                $parent = $galpage->getParent();
          
          ?>
          <div style="text-align: center">  
          <a href="<?php echo App::getIns()->setLink($galpage->get('pointer')->getValue()); ?>"><?php echo $parent->get('h1')->getValue() ?></a>        
          </div>
            <?php } ?>
     </div>   
<?php } ?>                                                
</div>
                    
    <br class="clear"><br><br>        