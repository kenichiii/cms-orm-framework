
$(function(){

    fillScreenGallery();
    
    $(window).resize(function(){
        fillScreenGallery();
    });
    
});

function fillScreenGallery()
{
        //count one width 
    var zncount = $(".hpznacka-box").length;
    var znwidth = Math.floor(100/zncount)-2;//margin
 
    //set width to hpznacky-box
    $(".hpznacka-box").css('width',znwidth.toString()+'%');

    //recount height, width
    var znwidthpx = parseInt($(".hpznacka-box").css('width'));
    
    
}