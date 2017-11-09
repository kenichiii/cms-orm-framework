<?php

    ob_start();
    
    $gallery = App::getIns()->currentPage()->getGallery()->orderby('rank DESC')->getData();
        
?>
$(function(){
    $('#gallery').autofillscreengallery({
        paths: [            
            <?php foreach($gallery as $key=> $image): ?>
              {
                small: "<?php echo Magick_Factory::thumb( '/'.App::getIns()->currentPage()->getGallery()->getDir().'/'.$image->getSrc()->getValue(), 460, 400,1,'f5f5f7' ); ?>",
                big: "<?php echo Magick_Factory::thumb( '/'.App::getIns()->currentPage()->getGallery()->getDir().'/'.$image->getSrc()->getValue(), 800, 600); ?>",
                title: "<?php echo str_replace('.jpg','',addslashes($image->getH1()->getValue())); ?>",
                link:  "<?php echo $image->getLink()->getValue() ? $image->getLink()->getValue() : str_replace('.jpg','',addslashes($image->getH1()->getValue())); ?>"
              }      
              <?php if( count($gallery)-1!=$key ) echo "," ?>
            <?php endforeach; ?>                
        ]
    });

  });      
<?php

    $jscode = ob_get_clean();
    
    __c()->set(App::getCurrentSuperCacheKey(),$jscode,60*60*24*21);
    
    echo $jscode;

?>       