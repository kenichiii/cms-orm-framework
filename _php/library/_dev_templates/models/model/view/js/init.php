

$(function(){

    <?php if( $model->isPhotoAble() ) { ?>    
      $(".<?php echo $model->getModelName(); ?>-foto-holder a").click(function(){  
       lightBoxGallery(".<?php echo $model->getModelName(); ?>-foto-holder a",this);
       return false;
      });
    <?php } ?> 


});