
<div class="gallery-admin-list">
<?php if(count($gallery)) { ?>

    <?php foreach( $gallery as $key => $img ): ?>
    <div class='gallery-img' id="photo_<?php echo $img->getId()->getValue(); ?>">
       <div class='gallery-img-img'> 
        <img src="<?php echo Project::$WEB_URL . Magick_Factory::thumb( '/'.$bean->getGallery()->getDir().'/'. $img->getSrc()->getValue(), 120, 120); ?>" alt=''>
       </div>
       <div class='gallery-img-texts'>           
           <div class='texts-view'>
              <h4><?php echo $img->getH1()->getValue() ?></h4>
              <p>
                  <b>Vytvořen:</b> <?php echo $img->getCreated()->getViewValue(); ?>
                  <br>
                  <b>Poslední aktualizace:</b> <?php echo $img->getLastupdate()->getViewValue(); ?>
                  <br><br>
              </p>
              <div><b>Soubor:</b> <?php echo Project::$WEB_URL ?>/<?php echo $bean->getGallery()->getDir().'/'.$img->getSrc()->getValue() ?></div>              
              <div class='texts-actions' style="padding-top: 15px">
                  <a class="gallery-edit button-link" href='<?php echo App::getIns()->setAjaxLink("_curr","news-gallery-item-edit",array("id"=>$img->getId()->getValue())); ?>'>upravit</a>
                       
                  <a class="gallery-delete button-link" href='<?php echo App::getIns()->setActionLink("_curr","news-gallery-delete",array("id"=>$img->getId()->getValue())) ?>'>smazat</a>
              </div>
           </div>
       </div>    
    </div>
    <?php endforeach; ?>

<?php } else { ?>
<br><br><b>Galerie je zatím prázdná.</b>
<?php } ?>
</div>
<br class='clear'>
