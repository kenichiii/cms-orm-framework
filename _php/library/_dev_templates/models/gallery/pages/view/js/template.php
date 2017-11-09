


$(function(){

      $(".<?php echo $model->getModelName(); ?>-gallery-img a").click(function(){  
       lightBoxGallery(".<?php echo $model->getModelName(); ?>-gallery-img a",this);
       return false;
      });

});