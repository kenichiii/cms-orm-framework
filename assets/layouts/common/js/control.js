

$(function(){
        
    jQuery(function($) {       
	    $.datepicker.regional['cs'] = {
	        closeText: 'Zavřít',
	        prevText: '&#x3c;Dříve',
	        nextText: 'Později&#x3e;',
	        currentText: 'Nyní',
	        monthNames: ['leden', 'únor', 'březen', 'duben', 'květen', 'červen', 'červenec', 'srpen',
	            'září', 'říjen', 'listopad', 'prosinec'],
	        monthNamesShort: ['led', 'úno', 'bře', 'dub', 'kvě', 'čer', 'čvc', 'srp', 'zář', 'říj', 'lis', 'pro'],
	        dayNames: ['neděle', 'pondělí', 'úterý', 'středa', 'čtvrtek', 'pátek', 'sobota'],
	        dayNamesShort: ['ne', 'po', 'út', 'st', 'čt', 'pá', 'so'],
	        dayNamesMin: ['ne', 'po', 'út', 'st', 'čt', 'pá', 'so'],
	        weekHeader: 'Týd',
	        dateFormat: 'dd.mm.yy',
	        firstDay: 1,
	        isRTL: false,
	        showMonthAfterYear: false,
	        yearSuffix: ''
	    };
	    $.datepicker.setDefaults($.datepicker.regional['cs']);
	});    
    
      href_blank();
      
      button_back()
});



function href_blank()
{
    $("a.blank").unbind('click').click(function(){       
       window.open(this.href);
       return false;
    });
}

function button_back()
{
    $('.formBack').click(function(){       
        window.history.back();
        return false;
    });
}


function lightBoxGallery(selector,href)
{
      $("body").append('<div id="lightGallery-overlay"></div>');
      $("body").append('<div id="lightGallery-holder" class="hidden"><div id="lightGallery-header"><a href="#" id="lightGallery-close"><img src="/assets/layouts/default/images/lightgallery/gallery_det_close.png"></a><span></span></div><div id="lightGallery-img"><img src=""><a id="lightGallery-goleft" href="#"></a><a id="lightGallery-goright" href="#"></a></div><div id="lightGallery-footer"></div></div>');
                
       var wwidth = $(window).width();  
       var wscrolltop = $(window).scrollTop();
      
       var pwidth = parseInt($('#lightGallery-holder').css('width'));               
       var pleft, pstarttop = (wscrolltop+15)+"px";
       
       if(wwidth>pwidth)
       {           
           //center
           pleft = ""+(wwidth/2-pwidth/2)+"px";           
       }
       else 
       {          
           pleft = "0px";
       }
    
      var currHref = $(href).attr('href');
      var currTitle = $(href).attr('title');
      $("#lightGallery-img img").attr('src',currHref);
      $("#lightGallery-header span").html(currTitle);
        
    
      $('#lightGallery-holder').css({'top':pstarttop,'left':pleft}).show();
      
      
      $("#lightGallery-overlay").css({width:(($(document).width())+"px"),height:(($(document).height())+"px")})
    
      $("#lightGallery-close").click(function(){
        $("#lightGallery-holder").remove();      
        $("#lightGallery-overlay").remove();
        return false;
      }); 
    
    
      var size = $(selector).length-1;
      var curr;  
      $(selector).each(function(index,el){
         if($(this).attr('href')==currHref&&$(this).attr('title')==currTitle) 
             curr = index;
      });  
    
      
 function activateGoLeft(curr,size) {
   
     $("#lightGallery-goleft").show(); 
     $("#lightGallery-goleft").unbind('click').click(function(){

                var newindex = curr-1;        
                $("#lightGallery-img img").attr('src',$(selector).eq(newindex).attr('href'));
                $("#lightGallery-header span").html($(selector).eq(newindex).attr('title'));
                curr = newindex;
                if(curr==0) $("#lightGallery-goleft").hide(); 
        
                   if(curr<size)  
                    {           
                       $("#lightGallery-goright").show(); 
                       $("#lightGallery-goright").unbind('click').click(function(){
                             var newindex = curr+1;        
                             $("#lightGallery-img img").attr('src',$(selector).eq(newindex).attr('href'));
                             $("#lightGallery-header span").html($(selector).eq(newindex).attr('title'));
                             curr = newindex;
                             if(curr==size) $("#lightGallery-goright").hide(); 
                             activateGoLeft(curr,size);
                             
                         return false;
                        })
                    }; 
              return false;      
            });                     
   
 } //end activateGoLeft

 function activateGoRight(curr,size)
 {
        $("#lightGallery-goright").show(); 
        $("#lightGallery-goright").unbind('click').click(function(){
                        var newindex = curr+1;        
                        $("#lightGallery-img img").attr('src',$(selector).eq(newindex).attr('href'));
                        $("#lightGallery-header span").html($(selector).eq(newindex).attr('title'));
                        curr = newindex;
                        if(curr==size) $("#lightGallery-goright").hide(); 
        
            if(curr>0)  
                {                 
                    $("#lightGallery-goleft").show(); 
                    $("#lightGallery-goleft").unbind('click').click(function(){
                                var newindex = curr-1;        
                                $("#lightGallery-img img").attr('src',$(selector).eq(newindex).attr('href'));
                                $("#lightGallery-header span").html($(selector).eq(newindex).attr('title'));
                                curr = newindex;
                                if(curr==0) $("#lightGallery-goleft").hide(); 
                                
                                activateGoRight(curr,size);

                        return false;
                    }); 
                } 
            else $("#lightGallery-goleft").hide(); 
             
           return false;
          }); 

 } //end activateGoRight
    
    
      
    
    if(curr>0)  
    {      
      $("#lightGallery-goleft").unbind('click').click(function(){
                var newindex = curr-1;        
                $("#lightGallery-img img").attr('src',$(selector).eq(newindex).attr('href'));
                $("#lightGallery-header span").html($(selector).eq(newindex).attr('title'));
                curr = newindex;
                if(curr==0) $("#lightGallery-goleft").hide(); 
            
                if(curr<size)  
                    {           
                       $("#lightGallery-goright").show(); 
                       $("#lightGallery-goright").unbind('click').click(function(){
                             var newindex = curr+1;        
                             $("#lightGallery-img img").attr('src',$(selector).eq(newindex).attr('href'));
                             $("#lightGallery-header span").html($(selector).eq(newindex).attr('title'));
                             curr = newindex;
                             if(curr==size) $("#lightGallery-goright").hide(); 
                             activateGoLeft(curr,size);
                         return false;
                        })
                    }; 
              return false;      
            });                     
       } 
       else $("#lightGallery-goleft").hide(); 
      

       if(curr<size)  
       {
         $("#lightGallery-goright").unbind('click').click(function(){

                        var newindex = curr+1;        
                        $("#lightGallery-img img").attr('src',$(selector).eq(newindex).attr('href'));
                        $("#lightGallery-header span").html($(selector).eq(newindex).attr('title'));
                        curr = newindex;
                        if(curr==size) $("#lightGallery-goright").hide(); 


            if(curr>0)  
                {                 
                    $("#lightGallery-goleft").show(); 
                    $("#lightGallery-goleft").unbind('click').click(function(){
                                var newindex = curr-1;        
                                $("#lightGallery-img img").attr('src',$(selector).eq(newindex).attr('href'));
                                $("#lightGallery-header span").html($(selector).eq(newindex).attr('title'));
                                curr = newindex;
                                if(curr==0) $("#lightGallery-goleft").hide(); 
                                
                                activateGoRight(curr,size);
                         
                      return false;
                    }); 
                } 
            else $("#lightGallery-goleft").hide(); 
            
             
           return false;
          }); 
       } 
       else $("#lightGallery-goright").hide(); 
      
}  //end lightBoxGallery

