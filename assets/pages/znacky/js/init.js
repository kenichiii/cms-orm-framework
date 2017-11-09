


/**
 * 
 * same height
 */
(function ( $ ) {
$.fn.sameHeight = function() {
        
    var mw = 0;    

    var cw;
    $(this).each(function() {       
        cw = parseInt($(this).css('height'));
        cw += parseInt($(this).css('padding-top'));
        cw += parseInt($(this).css('padding-bottom'));
        if(cw>mw) mw=cw;
    });
    
    if(mw>0)
    {        
        $(this).each(function() {        
            $(this).css('min-height',mw+'px');
        });      
    }
        
    return this;
};
}( jQuery ));



var r = null;
$(function(){
    
    /*
    $(".znacka").sameHeight().css('border','2px solid white');    
    $(".znacka img").load(function(){
            $(".znacka").sameHeight().css('border','2px solid white');
    })
    */
})
