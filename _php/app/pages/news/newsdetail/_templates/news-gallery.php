

<?php if(count($gallery)) { ?>

<div class="news-gallery-list">
    <b>Galerie: </b> <br>
    <?php foreach( $gallery as $key => $img ): ?>
    <div class='news-gallery-img'>
       <a href="<?php echo Magick_Factory::thumb( '/'. $bean->getGallery()->getDir().'/'. $img->getSrc()->getValue(), 800, 600); ?>" title='<?php echo str_replace('.jpg','',$img->getH1()->getValue()) ?>'>    
        <img src="<?php echo Magick_Factory::thumb( '/'. $bean->getGallery()->getDir().'/'. $img->getSrc()->getValue(), 250, 250); ?>" alt='<?php echo str_replace('.jpg','',$img->getH1()->getValue()) ?>'>
       </a>
    </div>    
    <?php endforeach; ?>
        
</div>
<br class='clear'>

<?php } ?>
