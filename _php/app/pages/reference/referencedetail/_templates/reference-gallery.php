

<?php if(count($gallery)) { ?>

<div class="reference-gallery-list">
    <b>Galerie: </b> <br>
    <?php foreach( $gallery as $key => $img ): ?>
    <div class='reference-gallery-img'>
        <a href="<?php echo Project::$WEB_URL . Magick_Factory::thumb( '/'. $bean->getGallery()->getDir().'/'. $img->getSrc()->getValue(), 800, 600); ?>" title='<?php echo $img->getH1()->getValue() ?>'>    
        <img src="<?php echo Project::$WEB_URL . Magick_Factory::thumb( '/'. $bean->getGallery()->getDir().'/'. $img->getSrc()->getValue(), 250, 250); ?>" alt='<?php echo $img->getH1()->getValue() ?>'>
       </a>
    </div>    
    <?php endforeach; ?>
        
</div>
<br class='clear'>

<?php } ?>
