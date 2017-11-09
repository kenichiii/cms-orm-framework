


[[ if(count($gallery)) { ]]

<div class="<?php echo $model->getModelName(); ?>-gallery-list">
    <b>Galerie: </b> <br>
    [[ foreach( $<?php echo $model->getModelName(); ?>_gallery as $key => $img ): ]]
    <div class='<?php echo $model->getModelName(); ?>-gallery-img'>
       <a href="[[ echo Project::$WEB_URL . Magick_Factory::thumb( '/'. $bean->getGallery()->getDir().'/'. $img->getSrc()->getValue(), 800, 600); ]]" title='[[ echo $img->getH1()->getValue() ]]'>    
        <img src="[[ echo Project::$WEB_URL . Magick_Factory::thumb( '/'. $bean->getGallery()->getDir().'/'. $img->getSrc()->getValue(), 250, 250); ]]" alt='[[ echo $img->getH1()->getValue() ]]'>
       </a>
    </div>    
    [[ endforeach; ]]
        
</div>
<br class='clear'>

[[ } ]]
