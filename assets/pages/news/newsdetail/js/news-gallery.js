

$(function(){

      $(".news-gallery-img a").click(function(){  
       lightBoxGallery(".news-gallery-img a",this);
       return false;
      });

});